<?php

namespace App\Actions;

use App\Models\Contact;

class UpdateContactAction
{
  public function execute(array $data, Contact $contact): Contact
  {
    $contact->update([
      'name' => data_get($data, 'name'),
      'contact' => data_get($data, 'contact'),
      'email' => data_get($data, 'email')
    ]);

    return $contact->fresh();
  }
}
