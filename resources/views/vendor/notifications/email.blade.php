@component('mail::message')
{{-- Greeting --}}
Xin chào

{{-- Intro Lines --}}
Bạn nhận được thư này bởi vì chúng tôi nhận được yêu cầu đặt lại mật khẩu từ bạn.

{{-- Action Button --}}
<?php
    $color = 'blue';
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
Đặt lại mật khẩu
@endcomponent

{{-- Outro Lines --}}
Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua thư này và không cần thực hiện bất kỳ thao tác nào.

{{-- Salutation --}}
Thân,<br> Ban Quản Trị

{{-- Subcopy --}}
@component('mail::subcopy')
Nếu bạn không thê mở đường dẫn "{{ $actionText }}" từ nut ở trên, vui lòng sao chép đường dẫn dưới đây và dán vào thanh địa chỉ trình duyệt của bạn: [{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endcomponent
