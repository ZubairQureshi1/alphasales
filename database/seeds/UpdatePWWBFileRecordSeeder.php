<?php

use App\Models\Pwwb\IndexTable;
use Illuminate\Database\Seeder;

class UpdatePWWBFileRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IndexTable::whereIn('file_module_number', ['M-440', 'M-208', 'M-241', 'M-282', 'M-284', 'M-283', 'M-281', 'M-297', 'M-774', 'M-379', 'M-398', 'M-116', 'M-696', 'M-395', 'M-298', 'M-107', 'M-137', 'M-121', 'M-173', 'M-209', 'M-148', 'M-143', 'M-79', 'M-86', 'M-103', 'M-125', 'M-124', 'M-123', 'M-150', 'M-149', 'M-153', 'M-65', 'M-171', 'M-122', 'M-126', 'M-113', 'M-244', 'M-181', 'M-111', 'M-109', 'M-99', 'M-100', 'M-170', 'M-77', 'M-78', 'M-80', 'M-195', 'M-182', 'M-105', 'M-69', 'M-71', 'M-196', 'M-128', 'M-61', 'M-64', 'M-67', 'M-51', 'M-56', 'M-183', 'M-129', 'M-138', 'M-139', 'M-92', 'M-97', 'M-96', 'M-141', 'M-95', 'M-114', 'M-165', 'M-127', 'M-162', 'M-106', 'M-142', 'M-159', 'M-339'])->update(['organization_campus_id' => 2]);

    }
}
