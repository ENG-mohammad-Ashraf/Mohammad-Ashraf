<?php
include 'db_config.php'; // تأكد أن ملف الاتصال موجود

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. استلام البيانات
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // 2. تخزين في قاعدة البيانات (للأمان وللرجوع لها لاحقاً)
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);
    $stmt->execute();

    // 3. إرسال الإيميل
    $to = "ma0976342@gmail.com";
    $email_subject = "New message from your website: " . $subject;
    
    // تنسيق محتوى الإيميل
    $email_body = "You have received a new message from: $name\n".
                  "Sender's email: $email\n\n".
                  "Subject: $subject\n".
                  "Message:\n$message";

    $headers = "From: webmaster@yourdomain.com"; // يفضل وضع إيميل رسمي لموقعك هنا

    // تنفيذ الإرسال
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "<script>alert('The message has been successfully stored and sent to your email!'); window.location.href='index.html';</script>";
    } else {
        echo "The message has been stored in the database, but failed to send via email.";
    }

    $stmt->close();
    $conn->close();
}
?>
