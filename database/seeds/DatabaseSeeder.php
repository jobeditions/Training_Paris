<?php
/**
 * Copyright (c) Liigem 2017.
 */
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SchoolsTableSeeder::class);
        $this->call(VersionsTableSeeder::class);
        $this->call(ClassesTableSeeder::class);
        $this->call(TeachersTableSeeder::class);
        $this->call(ClassesTeachersTableSeeder::class);
        $this->call(AssignmentsTableSeeder::class);
        $this->call(TeachersMessagesTableSeeder::class);
        $this->call(ExamsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(ClassesStudentsTableSeeder::class);
        $this->call(InvitesTableSeeder::class);
        $this->call(SchoolsStudentsTableSeeder::class);
        $this->call(SchoolsTeachersTableSeeder::class);
        $this->call(ClassePeriodsTableSeeder::class);
        $this->call(NewsfeedTableSeeder::class);
        $this->call(EdtPeriodTableSeeder::class);
        $this->call(MatieresTableSeeder::class);
        $this->call(NotesTableSeeder::class);
        $this->call(NotesStudentsTableSeeder::class);
        $this->call(ClassesMatieresTableSeeder::class);
        $this->call(AbsenceStudentTableSeeder::class);
        $this->call(AppelEnClasseTableSeeder::class);
        $this->call(StudentMatieresTableSeeder::class);
        $this->call(ClasseStudentTableSeeder::class);
        $this->call(ClasseTeacherTableSeeder::class);
        $this->call(EdtPeriodsTableSeeder::class);
        $this->call(SchoolStudentTableSeeder::class);
        $this->call(AdminSchoolsTableSeeder::class);
        $this->call(AdminTableSeeder::class);
    }
}
