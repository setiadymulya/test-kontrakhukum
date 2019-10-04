<?php

use Illuminate\Database\Seeder;
use App\Ticket;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tickets = [
            [
                'film' => 'Ayat-ayat Cinta',
                'date' => '2019-10-09',
                'start_time' => '12:00:00',
                'finish_time' => '22:00:00',
                'quantity' => '20',
            ], [
                'film' => 'Habibi & Ainun',
                'date' => '2019-08-01',
                'start_time' => '12:00:00',
                'finish_time' => '22:00:00',
                'quantity' => '15',
            ], [
                'film' => 'Romeo & Juliet',
                'date' => '2019-12-01',
                'start_time' => '12:00:00',
                'finish_time' => '22:00:00',
                'quantity' => '10',
            ], [
                'film' => 'Titanic 2',
                'date' => '2020-12-01',
                'start_time' => '12:00:00',
                'finish_time' => '22:00:00',
                'quantity' => '6',
            ], [
                'film' => 'Warkop DKI',
                'date' => '2020-02-01',
                'start_time' => '12:00:00',
                'finish_time' => '22:00:00',
                'quantity' => '8',
            ],
        ];

        foreach ($tickets as $key => $ticket):
            $data = [
                'film' => $ticket['film'],
                'date' => $ticket['date'],
                'start_time' => $ticket['start_time'],
                'finish_time' => $ticket['finish_time'],
                'quantity' => $ticket['quantity'],
            ];
            $row = Ticket::where($data);
            $row->count() > 0 ? $row : Ticket::create($data);
        endforeach;   
    }
}
