// EKRANIN BELİRTİLEN BÖLGESİNDE TOAST MESSAJI GÖSTERİR
const sweetAlertTypeList = {
    success:'success',  correct:'success',   ok:'success',
    okey:'success',     done:'success',      complete:'success', green:'success',
    error:'error',      danger:'error',     fail:'error',       red:'error',
    warning:'warning',  yellow:'warning',   orange:'warning',
    info:'info',        blue:'info',
    question:'question',
}

function showToast(opt = {message:''}){
    const Toast = Swal.mixin({
        toast: true,
        position: opt.position || 'top-end',
        showConfirmButton: false,
        timer: opt.timeout || 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        },
        icon: sweetAlertTypeList[opt.type] || 'success',  title: opt.message
    })
    Toast.fire()
}

function showModalForDelete(data={}){
    Swal.fire({
        title: data.title || '',
        html: ((data.text || data.body) || data.html) || '',
        icon: sweetAlertTypeList[data.type] || 'warning',
        showCancelButton: true,
        confirmButtonText: data.confirmButtonText || 'Eminim, sil!',
        cancelButtonText:  data.cancelButtonText || 'Vazgeç!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            if(data.emit){
                Livewire.emit(data.emit.name, data.emit.params || null);
            }
        }
    })
}
