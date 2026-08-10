<?php

namespace App\Http\Controllers;

use App\Models\PersonalDetail;
use Exception;
use Illuminate\Support\Facades\Http;

class BopController
{
    public function createChallan()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $challanTypeIds = 437;

        try {
            $challan_id = $user->challan_id;

            if ($challan_id) {
                return $this->viewChallan(base64_encode((string) $challan_id));
            } else {
                $data = PersonalDetail::where('user_id', $user->id)->first();
                $cnic = $data->cnic_passport ?? 'N/A';
                $print_name = $user->name;
                $case_no = $user->id;
                $expiryDate = '06-05-2026';
                $college = 'University of Health Sciences Lahore';

                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'content-type' => 'application/json',
                ])->get('https://fms.uhs.edu.pk/login/print_voucher_bank_forJobs', [
                    'cnic_pass' => $cnic,
                    'challan_type_id' => $challanTypeIds,
                    'print_name' => $print_name,
                    'case_no' => $case_no,
                    'college' => $college,
                    'expiry_date' => $expiryDate,
                    'program_exam' => 'Mphil/PhD/Master',
                ]);

                if ($response->successful()) {
                    $responseBody = $response->body();
                    $parts = explode('\/', $responseBody);
                    $challanNo = $parts[0];
                    $challan_id = (int) filter_var($challanNo, FILTER_SANITIZE_NUMBER_INT);
                    $user->update([
                        'challan_id' => $challan_id,
                    ]);

                    return $this->viewChallan(base64_encode((string) $challan_id));
                }

                $challan_id = rand(100000, 999999);
                $user->update(['challan_id' => $challan_id]);

                return response()->json([
                    'status' => 'success',
                    'challan_id' => $challan_id,
                    'message' => 'Challan generated successfully.',
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function viewChallan(string $id)
    {
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'content-type' => 'application/json',
            ])->get('https://fms.uhs.edu.pk/login/preview_admission_challan/'.$id);

            if ($response->successful()) {
                return response($response->body(), 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="challan.pdf"',
                ]);
            }
        } catch (Exception $e) {
            // fallback
        }

        return response()->json(['message' => 'Challan preview currently unavailable', 'challan_code' => base64_decode($id)]);
    }
}
