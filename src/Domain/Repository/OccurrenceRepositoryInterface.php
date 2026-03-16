<?php
declare(strict_types = 1)
;

namespace epiGuard\Domain\Repository;

use epiGuard\Domain\Entity\Occurrence;

interface OccurrenceRepositoryInterface
{
    public function findById(int $id): ?Occurrence;

    /**
     * @return Occurrence[]
     */
    public function findAll(): array;

    /**
     * @param int $employeeId
     * @return Occurrence[]
     */
    public function findByEmployeeId(int $employeeId): array;

    /**
     * @param string $status
     * @return Occurrence[]
     */
    public function findByStatus(string $status): array;
    
<<<<<<< HEAD
    public function countDaily(\DateTimeInterface $date): int;
    
    public function countWeekly(\DateTimeInterface $date): int;
    
    public function countMonthly(\DateTimeInterface $date): int;
=======
    public function countDaily(\DateTimeInterface $date, ?array $sectorIds = null): int;
    
    public function countWeekly(\DateTimeInterface $date, ?array $sectorIds = null): int;
    
    public function countMonthly(\DateTimeInterface $date, ?array $sectorIds = null): int;
>>>>>>> 5399806b2ad2a0f0a03798f8626547fceabfaeb9

    /**
     * Retorna array com contagens por mês para o gráfico de barras
     * Format: ['capacete' => [val1, val2...], 'oculos' => [...], 'total' => [...]]
     */
<<<<<<< HEAD
    public function getMonthlyInfractionStats(int $year): array;
=======
    public function getMonthlyInfractionStats(int $year, ?array $sectorIds = null): array;
>>>>>>> 5399806b2ad2a0f0a03798f8626547fceabfaeb9

    /**
     * Retorna array com distribuição por EPI para o gráfico de rosca
     */
<<<<<<< HEAD
    public function getInfractionDistributionByEpi(): array;
=======
    public function getInfractionDistributionByEpi(?array $sectorIds = null): array;

    public function findInfractions(array $filters = []): array;
>>>>>>> 5399806b2ad2a0f0a03798f8626547fceabfaeb9

    public function save(Occurrence $occurrence): void;

    public function update(Occurrence $occurrence): void;

    public function delete(Occurrence $occurrence): void;
}
