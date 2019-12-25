<?php

namespace App\Domain\Contact\Service;

use App\Domain\Contact\Data\ContactCreateData;
use App\Domain\Contact\Repository\EmailContactRepository;
use UnexpectedValueException;

/**
 * Service.
 */
final class EmailContact
{
    /**
     * @var EmailContactRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param EmailContactRepository $repository The repository
     */
    public function __construct(EmailContactRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new mail
     *
     * @param ContactCreateData $contact The email contact data
     *
     * @return int The new contact mail ID
     */
    public function createUser(ContactCreateData $contact): int
    {
        // Validation
//        if (empty($contact->username)) {
//            throw new UnexpectedValueException('Contact required');
//        }

        // Insert mail
        $mailId = $this->repository->insertMail($contact);

        // Logging here: Mail created successfully

        return $mailId;
    }
}