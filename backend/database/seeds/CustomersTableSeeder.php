<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = [
            [
                'name' => 'Deni',
                'phone' => '08782391819',
                'email' => 'deni@mail.com'
            ], [
                'name' => 'Gilbert',
                'phone' => '08782391833',
                'email' => 'gilbert@mail.com'
            ], [
                'name' => 'Brandon',
                'phone' => '08782391844',
                'email' => 'brandon@mail.com'
            ], [
                'name' => 'There',
                'phone' => '08782391844',
                'email' => 'there@mail.com'
            ], [
                'name' => 'Jill',
                'phone' => '08782391846',
                'email' => 'jill@mail.com'
            ],
        ];

        foreach ($customers as $key => $customer):
            $data = [
                'name' => $customer['name'],
                'phone' => $customer['phone'],
                'email' => $customer['email']
            ];
            $row = Customer::where($data);
            $row->count() > 0 ? $row : Customer::create($data);
        endforeach;   
    }
}
