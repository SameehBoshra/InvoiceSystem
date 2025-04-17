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

@if (session()->has('restorArchive'))
<script>
window.onload = function() {
notif({
    msg: "تم استرجاع الفاتورة بنجاح",
    type: "success"
})
}
</script>
@endif

@if (session()->has('export'))
<script>
window.onload = function() {
notif({
    msg: "تم  تصدير الفواتير بنجاح",
    type: "success"
})
}
</script>
@endif

@if (session()->has('notExport'))
<script>
window.onload = function() {
notif({
    msg: "لا توجد فواتير لتصديرها",
    type: "error"
})
}
</script>
@endif


@if (session()->has('Archive'))
<script>
window.onload = function() {
notif({
    msg: "تم أرشفة الفاتورة بنجاح",
    type: "success"
})
}
</script>
@endif


