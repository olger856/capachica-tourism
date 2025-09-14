<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use League\Csv\Statement;
use App\Models\Attraction;

class CsvUploadController extends Controller
{
    protected $userIdMap = [];
    protected $destinationIdMap = [];

    public function index()
    {
        return view('admin.csv-upload');
    }

    public function uploadCsv(Request $request)
    {
        ini_set('max_execution_time', 300); // 5 minutos

        $request->validate([
            'users_csv' => 'required|file|mimes:csv,txt',
            'destinations_csv' => 'required|file|mimes:csv,txt',
            'reviews_csv' => 'required|file|mimes:csv,txt',
            'history_csv' => 'required|file|mimes:csv,txt',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->importUsers($request->file('users_csv'));
        $this->importDestinations($request->file('destinations_csv'));
        $this->importReviews($request->file('reviews_csv'));
        $this->importHistory($request->file('history_csv'));

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return back()->with('success', 'Archivos CSV importados correctamente.');
    }

    private function importUsers($file)
    {
        $csv = Reader::createFromPath($file->getPathname(), 'r');
        $csv->setHeaderOffset(0);
        $stmt = new Statement();

        $chunkSize = 500;
        $offset = 0;

        do {
            $records = $stmt->offset($offset)->limit($chunkSize)->process($csv);
            if ($records->count() === 0) break;

            foreach ($records as $record) {
                $email = strtolower(trim($record['Email']));
                DB::table('users')->updateOrInsert(
                    ['email' => $email],
                    [
                        'name' => $record['Name'],
                        'password' => bcrypt('password123'),
                        'role_id' => 3,
                        'updated_at' => now(),
                    ]
                );
                $realId = DB::table('users')->where('email', $email)->value('id');
                $this->userIdMap[$record['UserID']] = $realId;
            }
            $offset += $chunkSize;
        } while (true);
    }

    private function importDestinations($file)
    {
        $csv = Reader::createFromPath($file->getPathname(), 'r');
        $csv->setHeaderOffset(0);
        $stmt = new Statement();

        $chunkSize = 500;
        $offset = 0;

        do {
            $records = $stmt->offset($offset)->limit($chunkSize)->process($csv);
            if ($records->count() === 0) break;

            foreach ($records as $record) {
                $name = trim($record['Name']);

                DB::table('destinations')->updateOrInsert(
                    ['name' => $name],
                    [
                        'state' => $record['State'],
                        'type' => $record['Type'],
                        'popularity' => $record['Popularity'],
                        'best_time_to_visit' => $record['BestTimeToVisit'] ?? null,
                        'updated_at' => now(),
                    ]
                );

                $destinationId = DB::table('destinations')->where('name', $name)->value('destination_id');
                $this->destinationIdMap[$record['DestinationID']] = $destinationId;

                Attraction::updateOrCreate(
                    ['id' => $destinationId],
                    [
                        'name' => $name,
                        'type' => $record['Type'],
                        'description' => $record['State'],
                        'latitude' => null,
                        'longitude' => null,
                    ]
                );
            }
            $offset += $chunkSize;
        } while (true);
    }

    private function importReviews($file)
    {
        $csv = Reader::createFromPath($file->getPathname(), 'r');
        $csv->setHeaderOffset(0);
        $stmt = new Statement();

        $chunkSize = 500;
        $offset = 0;

        do {
            $records = $stmt->offset($offset)->limit($chunkSize)->process($csv);
            if ($records->count() === 0) break;

            foreach ($records as $record) {
                $realUserId = $this->userIdMap[$record['UserID']] ?? null;
                $realDestinationId = $this->destinationIdMap[$record['DestinationID']] ?? null;

                if ($realUserId && $realDestinationId) {
                    DB::table('reviews')->updateOrInsert(
                        [
                            'user_id' => $realUserId,
                            'destination_id' => $realDestinationId,
                        ],
                        [
                            'rating' => $record['Rating'] ?? 0,
                            'comment' => $record['ReviewText'] ?? null,
                            'updated_at' => now(),
                        ]
                    );

                    DB::table('comments')->updateOrInsert(
                        [
                            'user_id' => $realUserId,
                            'attraction_id' => $realDestinationId,
                        ],
                        [
                            'rating' => $record['Rating'] ?? 0,
                            'comment' => $record['ReviewText'] ?? null,
                            'updated_at' => now(),
                            'created_at' => now(),
                        ]
                    );
                }
            }
            $offset += $chunkSize;
        } while (true);
    }

    private function importHistory($file)
    {
        $csv = Reader::createFromPath($file->getPathname(), 'r');
        $csv->setHeaderOffset(0);
        $stmt = new Statement();

        $chunkSize = 500;
        $offset = 0;

        do {
            $records = $stmt->offset($offset)->limit($chunkSize)->process($csv);
            if ($records->count() === 0) break;

            foreach ($records as $record) {
                $realUserId = $this->userIdMap[$record['UserID']] ?? null;
                $realDestinationId = $this->destinationIdMap[$record['DestinationID']] ?? null;

                if ($realUserId && $realDestinationId) {
                    DB::table('user_histories')->updateOrInsert(
                        [
                            'user_id' => $realUserId,
                            'destination_id' => $realDestinationId,
                            'visited_at' => $record['VisitedAt'] ?? now(),
                        ],
                        [
                            'updated_at' => now(),
                        ]
                    );
                }
            }
            $offset += $chunkSize;
        } while (true);
    }
}
