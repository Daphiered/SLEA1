<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentPersonalInformation;
use App\Models\StudentPassword;
use App\Models\Profile;
use App\Models\AcademicInformation;
use App\Models\LeadershipInformation;
use App\Models\CorSubmission;
use App\Models\Submission;
use App\Models\PendingSubmission;
use App\Models\SubmissionRecord;
use App\Models\SubmissionOversight;
use App\Models\FinalReviewRequest;
use App\Models\FinalReview;
use App\Models\AwardReport;
use App\Models\ApprovalOfAccount;
use App\Models\UpdateProgram;
use App\Models\UpdateYearLevel;
use App\Models\ChangePassword;
use App\Models\LogIn;
use App\Models\Otp;
use Illuminate\Support\Facades\Hash;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create additional student accounts (only if they don't exist)
        $additionalStudents = [
            [
                'student_id' => 'STU006',
                'last_name' => 'Lopez',
                'first_name' => 'Carlos',
                'middle_name' => 'Manuel',
                'email_address' => 'carlos.lopez2@student.university.edu',
                'contact_number' => '+639456789012',
                'date_of_birth' => '1998-11-08',
                'gender' => 'Male',
                'address' => '321 Elm Street, Cebu City, Philippines',
                'dateacc_created' => now()->subDays(18),
            ],
            [
                'student_id' => 'STU007',
                'last_name' => 'Martinez',
                'first_name' => 'Sofia',
                'middle_name' => 'Isabella',
                'email_address' => 'sofia.martinez2@student.university.edu',
                'contact_number' => '+639567890123',
                'date_of_birth' => '2002-02-14',
                'gender' => 'Female',
                'address' => '654 Maple Drive, Davao City, Philippines',
                'dateacc_created' => now()->subDays(12),
            ],
        ];

        foreach ($additionalStudents as $student) {
            // Only create if student doesn't exist
            if (!StudentPersonalInformation::where('student_id', $student['student_id'])->exists()) {
                StudentPersonalInformation::create($student);
            }
        }

        // Create additional student passwords
        $additionalPasswords = [
            [
                'student_id' => 'STU006',
                'password_hashed' => Hash::make('student123'),
                'date_pass_created' => now()->subDays(18),
            ],
            [
                'student_id' => 'STU007',
                'password_hashed' => Hash::make('student123'),
                'date_pass_created' => now()->subDays(12),
            ],
        ];

        foreach ($additionalPasswords as $password) {
            // Only create if password doesn't exist
            if (!StudentPassword::where('student_id', $password['student_id'])->exists()) {
                StudentPassword::create($password);
            }
        }

        // Create additional student profiles
        $additionalProfiles = [
            [
                'profile_id' => 'PROF006',
                'student_id' => 'STU006',
                'picture_path' => 'student_profiles/carlos_lopez.jpg',
                'date_upload' => now()->subDays(15),
            ],
            [
                'profile_id' => 'PROF007',
                'student_id' => 'STU007',
                'picture_path' => null,
                'date_upload' => now()->subDays(10),
            ],
        ];

        foreach ($additionalProfiles as $profile) {
            // Only create if profile doesn't exist
            if (!Profile::where('profile_id', $profile['profile_id'])->exists()) {
                Profile::create($profile);
            }
        }

        // Create academic information for all students
        $academicInfo = [
            [
                'student_id' => 'STU001',
                'program' => 'BSIT',
                'major' => 'Web Development',
                'year_level' => '3rd Year',
                'graduate_prior' => 0,
            ],
            [
                'student_id' => 'STU002',
                'program' => 'BSCS',
                'major' => 'Software Engineering',
                'year_level' => '4th Year',
                'graduate_prior' => 0,
            ],
            [
                'student_id' => 'STU003',
                'program' => 'BSIS',
                'major' => 'Database Management',
                'year_level' => '2nd Year',
                'graduate_prior' => 0,
            ],
            [
                'student_id' => 'STU006',
                'program' => 'BSIT',
                'major' => 'Network Administration',
                'year_level' => '3rd Year',
                'graduate_prior' => 0,
            ],
            [
                'student_id' => 'STU007',
                'program' => 'BSCS',
                'major' => 'Artificial Intelligence',
                'year_level' => '1st Year',
                'graduate_prior' => 0,
            ],
        ];

        foreach ($academicInfo as $academic) {
            // Only create if academic info doesn't exist
            if (!AcademicInformation::where('student_id', $academic['student_id'])->exists()) {
                AcademicInformation::create($academic);
            }
        }

        // Create leadership information
        $leadershipInfo = [
            [
                'student_id' => 'STU001',
                'organization_name' => 'Computer Science Society',
                'organization_role' => 'Vice President',
                'term' => '2024-2025',
                'hours_log' => '120 hours',
                'leadership_status' => 'Active',
            ],
            [
                'student_id' => 'STU001',
                'organization_name' => 'Student Council',
                'organization_role' => 'Secretary',
                'term' => '2024-2025',
                'hours_log' => '80 hours',
                'leadership_status' => 'Active',
            ],
            [
                'student_id' => 'STU002',
                'organization_name' => 'Programming Club',
                'organization_role' => 'President',
                'term' => '2024-2025',
                'hours_log' => '150 hours',
                'leadership_status' => 'Active',
            ],
            [
                'student_id' => 'STU003',
                'organization_name' => 'Women in Tech',
                'organization_role' => 'Treasurer',
                'term' => '2024-2025',
                'hours_log' => '90 hours',
                'leadership_status' => 'Active',
            ],
            [
                'student_id' => 'STU006',
                'organization_name' => 'Network Security Club',
                'organization_role' => 'Member',
                'term' => '2024-2025',
                'hours_log' => '60 hours',
                'leadership_status' => 'Active',
            ],
        ];

        foreach ($leadershipInfo as $leadership) {
            // Only create if leadership info doesn't exist for this student and organization
            if (!LeadershipInformation::where('student_id', $leadership['student_id'])
                ->where('organization_name', $leadership['organization_name'])
                ->exists()) {
                LeadershipInformation::create($leadership);
            }
        }

        // Create COR submissions
        $corSubmissions = [
            [
                'student_id' => 'STU001',
                'file_name' => 'COR_2024_2025_STU001.pdf',
                'file_type' => 'pdf',
                'file_size' => 245,
                'upload_date' => now()->subDays(20),
                'academic_year' => '2024-2025',
                'status' => 'Approved',
            ],
            [
                'student_id' => 'STU002',
                'file_name' => 'COR_2024_2025_STU002.pdf',
                'file_type' => 'pdf',
                'file_size' => 198,
                'upload_date' => now()->subDays(18),
                'academic_year' => '2024-2025',
                'status' => 'Approved',
            ],
            [
                'student_id' => 'STU003',
                'file_name' => 'COR_2024_2025_STU003.pdf',
                'file_type' => 'pdf',
                'file_size' => 267,
                'upload_date' => now()->subDays(15),
                'academic_year' => '2024-2025',
                'status' => 'Pending',
            ],
            [
                'student_id' => 'STU006',
                'file_name' => 'COR_2024_2025_STU006.pdf',
                'file_type' => 'pdf',
                'file_size' => 189,
                'upload_date' => now()->subDays(12),
                'academic_year' => '2024-2025',
                'status' => 'Pending',
            ],
        ];

        foreach ($corSubmissions as $cor) {
            // Only create if COR submission doesn't exist for this student and academic year
            if (!CorSubmission::where('student_id', $cor['student_id'])
                ->where('academic_year', $cor['academic_year'])
                ->exists()) {
                CorSubmission::create($cor);
            }
        }

        // Create submissions (simple action records)
        $submissions = [
            [
                'pending_sub_id' => 1,
                'assessor_id' => 'PROF001',
                'action' => 'Approved',
            ],
            [
                'pending_sub_id' => 2,
                'assessor_id' => 'PROF002',
                'action' => 'Under Review',
            ],
        ];

        foreach ($submissions as $submission) {
            // Only create if submission doesn't exist
            if (!Submission::where('pending_sub_id', $submission['pending_sub_id'])->exists()) {
                Submission::create($submission);
            }
        }

        // Create pending submissions
        $pendingSubmissions = [
            [
                'submission_id' => 1,
                'assessor_id' => 'PROF001',
                'submission_status' => 'Pending',
                'date_submitted' => now()->subDays(5),
                'remarks' => 'Awaiting initial review',
            ],
            [
                'submission_id' => 2,
                'assessor_id' => 'PROF002',
                'submission_status' => 'Under Review',
                'date_submitted' => now()->subDays(3),
                'remarks' => 'Currently being assessed',
            ],
        ];

        foreach ($pendingSubmissions as $pending) {
            // Only create if pending submission doesn't exist
            if (!PendingSubmission::where('submission_id', $pending['submission_id'])->exists()) {
                PendingSubmission::create($pending);
            }
        }

        // Create submission records
        $submissionRecords = [
            [
                'submission_id' => 1,
                'leadership_id' => 1,
                'activity_title' => 'Web Development Project',
                'activity_type' => 'Academic Project',
                'activity_role' => 'Developer',
                'activity_date' => now()->subDays(5),
                'organizational_body' => 'Computer Science Department',
                'team' => 'Team Alpha',
                'based_by' => 'Dr. Smith',
                'order_by' => 'Course Requirement',
                'dimension_level' => 'Advanced',
                'idea_category' => 'Technology',
                'idea_sub_category' => 'Web Development',
                'submission_file_path' => 'submissions/web_project_stu001.pdf',
                'submission_status' => 'Submitted',
                'submission_final_date' => now()->addDays(30),
                'date_submitted' => now()->subDays(5),
                'remarks' => 'Excellent project implementation',
            ],
        ];

        foreach ($submissionRecords as $record) {
            SubmissionRecord::create($record);
        }

        // Create submission oversight records
        $submissionOversights = [
            [
                'pending_sub_id' => 1,
                'admin_id' => 'SUPER001',
                'submission_status' => 'Under Review',
                'flag' => 'Normal',
            ],
            [
                'pending_sub_id' => 2,
                'admin_id' => 'ADMIN002',
                'submission_status' => 'Under Review',
                'flag' => 'Normal',
            ],
        ];

        foreach ($submissionOversights as $oversight) {
            SubmissionOversight::create($oversight);
        }

        // Create final review requests
        $finalReviewRequests = [
            [
                'submission_id' => 1,
                'request_date' => now()->subDays(2),
                'status' => 'Pending',
                'remarks' => 'Ready for final review',
            ],
            [
                'submission_id' => 2,
                'request_date' => now()->subDays(1),
                'status' => 'Pending',
                'remarks' => 'Assessment completed, ready for review',
            ],
        ];

        foreach ($finalReviewRequests as $request) {
            FinalReviewRequest::create($request);
        }

        // Create final reviews
        $finalReviews = [
            [
                'final_review_id' => 1,
                'admin_id' => 'SUPER001',
                'date_reviewed' => now(),
                'remarks' => 'Project meets all requirements. Approved for award consideration.',
                'status' => 'Approved',
            ],
        ];

        foreach ($finalReviews as $review) {
            FinalReview::create($review);
        }

        // Create award reports
        $awardReports = [
            [
                'final_review_id' => 1,
                'admin_id' => 'SUPER001',
                'award_type' => 'Excellence in Web Development',
                'award_date' => now(),
                'remarks' => 'Outstanding project demonstrating technical excellence',
            ],
        ];

        foreach ($awardReports as $award) {
            AwardReport::create($award);
        }

        // Create approval records
        $approvals = [
            [
                'admin_id' => 'SUPER001',
                'student_id' => 'STU001',
                'action' => 'Approved',
                'date_time' => now()->subDays(10),
            ],
            [
                'admin_id' => 'ADMIN002',
                'student_id' => 'STU002',
                'action' => 'Approved',
                'date_time' => now()->subDays(8),
            ],
        ];

        foreach ($approvals as $approval) {
            ApprovalOfAccount::create($approval);
        }

        // Create program updates
        $programUpdates = [
            [
                'student_id' => 'STU001',
                'old_program' => 'BSIS',
                'new_program' => 'BSIT',
                'date_prog_changed' => now()->subDays(60),
                'reason' => 'Better alignment with career goals',
            ],
        ];

        foreach ($programUpdates as $update) {
            UpdateProgram::create($update);
        }

        // Create year level updates
        $yearLevelUpdates = [
            [
                'student_id' => 'STU001',
                'old_year_level' => '2nd Year',
                'new_year_level' => '3rd Year',
                'date_year_level_changed' => now()->subDays(30),
                'reason' => 'Completed required credits',
            ],
        ];

        foreach ($yearLevelUpdates as $update) {
            UpdateYearLevel::create($update);
        }

        // Create change password records
        $changePasswords = [
            [
                'email_address' => 'maria.garcia@student.university.edu',
                'old_password' => 'oldpassword123',
                'new_password' => 'newpassword456',
                'date_changed' => now()->subDays(15),
            ],
        ];

        foreach ($changePasswords as $change) {
            ChangePassword::create($change);
        }

        // Create additional login records
        $additionalLogins = [
            [
                'email_address' => 'carlos.lopez@student.university.edu',
                'user_role' => 'student',
                'login_datetime' => now()->subDays(8),
            ],
            [
                'email_address' => 'sofia.martinez@student.university.edu',
                'user_role' => 'student',
                'login_datetime' => now()->subDays(6),
            ],
        ];

        foreach ($additionalLogins as $login) {
            LogIn::create($login);
        }

        // Create OTP records
        $otpRecords = [
            [
                'log_id' => 6,
                'otp' => '123456',
                'expires_at' => now()->addMinutes(10),
                'is_used' => false,
            ],
            [
                'log_id' => 7,
                'otp' => '789012',
                'expires_at' => now()->addMinutes(10),
                'is_used' => false,
            ],
        ];

        foreach ($otpRecords as $otp) {
            Otp::create($otp);
        }

        $this->command->info('Master seeder completed successfully!');
        $this->command->info('Created:');
        $this->command->info('- 2 additional students with complete profiles');
        $this->command->info('- Academic information for all students');
        $this->command->info('- Leadership activities and organizations');
        $this->command->info('- COR submissions with various statuses');
        $this->command->info('- Complete submission workflow (submissions, pending, records, oversight)');
        $this->command->info('- Final review requests and reviews');
        $this->command->info('- Award reports and approvals');
        $this->command->info('- Program and year level updates');
        $this->command->info('- Password changes and OTP records');
    }
}
