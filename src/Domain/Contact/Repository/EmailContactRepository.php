<?php

namespace App\Domain\Contact\Repository;

use App\Domain\Contact\Data\ContactCreateData;
use PDO;

/**
 * Repository.
 */
class EmailContactRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Insert mail log row.
     *
     * @param ContactCreateData $contact The contact detail
     *
     * @return int The new ID
     */
    public function insertUser(ContactCreateData $contact): int
    {
        $row = [
            'senderEmail'   => $contact->senderEmail,
            'title'         => $contact->title,
            'description'   => $contact->description,
            'timestamp'     => $contact->timestamp,
        ];

        $sql = "INSERT INTO mail_log SET 
                senderEmail=:smail, 
                title=:title, 
                description=:descr, 
                timestamp=:timestamp;";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }
}