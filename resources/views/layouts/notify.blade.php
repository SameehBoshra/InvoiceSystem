@if (session()->has('Add'))
<script>
    window.onload = function() {
        notif({
            msg: "تم أضافة الفاتورة بنجاح",
            type: "success"
        })
    }
</script>
@endif
@if (session()->has('Delete'))
<script>
window.onload = function() {
    notif({
        msg:  "تم حذف الفاتورة بنجاح",
        type: "success"
    })
}
</script>
@endif
@if (session()->has('Update'))
<script>
window.onload = function() {
notif({
    msg: "تم تحديث الفاتورة بنجاح",
    type: "success"
})
}
</script>
@endif

@if (session()->has('Error'))
<script>
window.onload = function() {
notif({
    msg: "حدث خطأ ما",
    type: "error"
})
}
</script>
@endif

@if (session()->has('Status_Update'))
<script>
window.onload = function() {
notif({
    msg: "تم تحديث حالة الفاتورة بنجاح",
    type: "success"
})
}
</script>
@endif
