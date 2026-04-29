<?php

namespace App\Actions;

use App\Models\Contact;

class CreateContactAction
{
  public function execute(array $data): Contact
  {
    return Contact::create([
      'name' => data_get($data, 'name'),
      'contact' => data_get($data, 'contact'),
      'email' => data_get($data, 'email')
    ]);
  }
}
