<?php
class AssignmentModel {
    public static function assignToEmployee($booking_id) {
        $db = new MyDB();
        
        // Get pet type from booking
        $pet_type = $db->query("SELECT pet_type FROM bookings WHERE id=$booking_id")->fetch_row()[0];
        
        // Find available employee
        $employee = $db->query("SELECT id FROM employees WHERE pet_type='$pet_type' ORDER BY RAND() LIMIT 1")->fetch_assoc();
        
        if ($employee) {
            $db->query("UPDATE bookings SET employee_id=".$employee['id']." WHERE id=$booking_id");
        }
    }
}
?>