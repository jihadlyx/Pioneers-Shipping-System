<!DOCTYPE html>
<html>
<head>
    <title>إعادة تعيين كلمة المرور</title>
</head>
<body>
<p>لإعادة تعيين كلمة المرور، الرجاء الضغط على الرابط التالي خلال دقيقة واحدة:</p>
<p>
    <a href="{{ $resetLink }}" class="save-data w-full cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90">
        إعادة تعيين كلمة السر
    </a>
</p>
<p>هذا الرابط سينتهي صلاحيته في: {{ $expiresAt }}</p>
</body>
</html>
