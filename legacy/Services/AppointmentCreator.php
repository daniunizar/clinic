<?php

namespace Legacy\Services;

use Legacy\Database;
use PDO;
use Exception;
use RuntimeException;
use Src\Platform\Appointment\Domain\Entities\Appointment;

final class AppointmentCreator
{
    private PDO $pdo;

    public function __construct(Database $database)
    {
        $this->pdo = $database->getPdo();
    }

    public function create(Appointment $appointmentData): string
    {
        try {
            $this->pdo->beginTransaction();

            $sql = "INSERT INTO appointments (id, patient_id, dentist_id, start, finish, description, appointment_status_id, created_at, updated_at) VALUES (:id, :patient_id, :dentist_id, :start, :finish, :description, :appointment_status_id, :created_at, :updated_at)";
            $stmt = $this->pdo->prepare($sql);

            $inicio = $appointmentData->getStart()->format('Y-m-d H:i:s');
            $fin = $appointmentData->getFinish()->format('Y-m-d H:i:s');
            $now = (new \DateTimeImmutable())->format('Y-m-d H:i:s'); //for created_at and updated_at

            $stmt->execute([
                ':id' => $appointmentData->getId(),
                ':patient_id' => $appointmentData->getPatientId(),
                ':dentist_id' => $appointmentData->getDentistId(),
                ':start' => $inicio,
                ':finish' => $fin,
                ':description' => $appointmentData->getDescription(),
                ':appointment_status_id' => $appointmentData->getStatusId(),
                ':created_at' => $now,
                ':updated_at' => $now,
            ]);

            $this->pdo->commit();

            return $appointmentData->getId();
        } catch (Exception $e) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }

            throw new RuntimeException('Legacy AppointmentCreator failed: ' . $e->getMessage(), 0, $e);
        }
    }
}
