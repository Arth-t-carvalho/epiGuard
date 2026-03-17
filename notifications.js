/**
 * Premium Notification System for epiGuard
 */

function showInfractionNotification(data) {
    let container = document.getElementById('notification-container');
    
    // Create container if it doesn't exist
    if (!container) {
        container = document.createElement('div');
        container.id = 'notification-container';
        container.className = 'notification-container';
        document.body.appendChild(container);
    }

    const { sector, name, missingEpis, time } = data;

    const toast = document.createElement('div');
    toast.className = 'infraction-toast';

    // Map EPI names to icons (FontAwesome)
    const epiIcons = {
        'Óculos': 'fa-solid fa-glasses',
        'Capacete': 'fa-solid fa-hard-hat',
        'Luvas': 'fa-solid fa-mitten',
        'Bota': 'fa-solid fa-boot',
        'Máscara': 'fa-solid fa-mask-face',
        'Auricular': 'fa-solid fa-ear-deaf',
        'Colete': 'fa-solid fa-vest'
    };

    const epiHtml = missingEpis.map(epi => `
        <div class="epi-item">
            <i class="${epiIcons[epi] || 'fa-solid fa-shield'}"></i>
            <span>${epi}</span>
        </div>
    `).join('');

    const currentTime = time || new Date().toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });

    toast.innerHTML = `
        <div class="toast-icon-wrapper">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <div class="toast-content">
            <div class="toast-header">
                <span class="toast-title">Infração Detectada</span>
                <button class="btn-close-toast" onclick="closeToast(this)">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="toast-body">
                <div class="toast-info-line">Setor: ${sector} | Nome: <strong>${name}</strong></div>
                <div class="missing-epis">
                    ${epiHtml}
                </div>
            </div>
            <div class="toast-footer">
                <span class="toast-time">${currentTime}</span>
            </div>
        </div>
    `;

    container.appendChild(toast);

    // Auto-dismiss after 10 seconds
    const timeoutId = setTimeout(() => {
        if (toast.parentElement) closeToast(toast.querySelector('.btn-close-toast'));
    }, 10000);

    // Store timeout ID to clear if manually closed
    toast.dataset.timeoutId = timeoutId;
}

function closeToast(btn) {
    if (!btn) return;
    const toast = btn.closest('.infraction-toast');
    if (!toast || toast.classList.contains('closing')) return;

    // Clear auto-dismiss timeout
    if (toast.dataset.timeoutId) {
        clearTimeout(parseInt(toast.dataset.timeoutId));
    }

    toast.classList.add('closing');
    setTimeout(() => {
        toast.remove();
    }, 400);
}

// Notification State
let lastInfractionId = localStorage.getItem('lastInfractionId') || 0;
let notificationCount = parseInt(sessionStorage.getItem('notificationCount')) || 0;
let isPolling = false;

// Update UI Badge
function updateHeaderBadge() {
    const badge = document.getElementById('headerNotificationBadge');
    if (!badge) return;

    const isOnInfractionsPage = window.location.pathname.includes('/infractions');
    
    if (isOnInfractionsPage) {
        notificationCount = 0;
        sessionStorage.setItem('notificationCount', 0);
    }

    if (notificationCount > 0) {
        badge.textContent = notificationCount > 99 ? '99+' : notificationCount;
        badge.style.display = 'flex';
    } else {
        badge.style.display = 'none';
    }
}

async function checkNewInfractions() {
    if (isPolling) return;
    isPolling = true;

    try {
        const response = await fetch(`${window.location.origin}/epiGuard/api/notifications/check?last_id=${lastInfractionId}`);
        const result = await response.json();

        if (result.status === 'init') {
            lastInfractionId = result.last_id;
            localStorage.setItem('lastInfractionId', lastInfractionId);
        } else if (result.status === 'success' && result.data && result.data.length > 0) {
            const isOnInfractionsPage = window.location.pathname.includes('/infractions');
            
            result.data.forEach(infraction => {
                showInfractionNotification(infraction);
                lastInfractionId = Math.max(lastInfractionId, infraction.id);
                
                if (!isOnInfractionsPage) {
                    notificationCount++;
                }
            });

            if (!isOnInfractionsPage) {
                sessionStorage.setItem('notificationCount', notificationCount);
                updateHeaderBadge();
            }

            localStorage.setItem('lastInfractionId', lastInfractionId);
        }
    } catch (err) {
        console.error('Error polling infractions:', err);
    } finally {
        isPolling = false;
    }
}

// Start polling every 5 seconds
setInterval(checkNewInfractions, 5000);

// Initial setup
updateHeaderBadge();
checkNewInfractions();

// Global exposure
window.showInfractionNotification = showInfractionNotification;
window.closeToast = closeToast;
