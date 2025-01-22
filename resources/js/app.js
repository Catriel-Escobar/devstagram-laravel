import './bootstrap';
import Dropzone from "dropzone";

Dropzone.autoDiscover = false;


const dropzone = new Dropzone('#my-form', {
    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: ".png,.jpg,.jpeg,.gif,.bmp",
    addRemoveLinks: true,
    dictRemoveFile: 'Eliminar',
    maxFiles: 1,
    uploadMultiple: false,
    paramName: "file",  // Nombre del campo que espera Laravel
    init: function() {
        if(document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {}
            imagenPublicada.size = 12345;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;
            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);
            imagenPublicada.previewElement.classList.add('dz-success','dz-complete');
    }
}
});

dropzone.on('sending',function(file,xhr,formData){
    console.log(file,xhr,formData);
});

dropzone.on('success',function(file,response){
    console.log(response);
    document.querySelector('[name="imagen"]').value = response.extension;
});

dropzone.on('removedfile',function(){
    document.querySelector('[name="imagen"]').value = '';
});