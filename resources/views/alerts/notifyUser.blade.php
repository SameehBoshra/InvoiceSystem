
@if (session()->has('add'))
    <script>
        window.onload = function() {
            notif({
                msg: " تم اضافة المستخدم بنجاح",
                type: "success"
            });
        }

    </script>
@endif

@if (session()->has('edit'))
    <script>
        window.onload = function() {
            notif({
                msg: " تم تحديث بيانات المستخدم بنجاح",
                type: "success"
            });
        }

    </script>
@endif

@if (session()->has('error'))
    <script>
        window.onload = function() {
            notif({
                msg: " حدث خطأ ما",
                type: "error"
            });
        }

    </script>
@endif

@if (session()->has('delete'))
    <script>
        window.onload = function() {
            notif({
                msg: " تم حذف المستخدم بنجاح",
                type: "success"
            });
        }

    </script>
@endif