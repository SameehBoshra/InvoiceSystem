@if (session()->has('Add'))
<script>
    window.onload = function() {
        notif({
            msg: "تم أضافة المنتج بنجاح",
            type: "success"
        })
    }
</script>
@endif
@if (session()->has('Delete'))
<script>
window.onload = function() {
    notif({
        msg:  "تم حذف المنتج بنجاح",
        type: "success"
    })
}
</script>
@endif
@if (session()->has('Update'))
<script>
window.onload = function() {
notif({
    msg: "تم تحديث المنتج بنجاح",
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
