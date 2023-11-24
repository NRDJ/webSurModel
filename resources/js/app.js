require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();



// import * as FilePond from 'filepond';

// const inputElement = document.querySelector('input[name="image[]"]');
// const token = document.querySelector('input[name="_token"]');
// const user_id = document.querySelector('input[name="user_id"]');
// // Create a FilePond instance
// const pond = FilePond.create(inputElement);

// FilePond.setOptions({
//     acceptedFileTypes: ['image/png'],
//     name:'image',
//     server: {
//         url: '/dashboard/photos/upload/'+user_id.value,
//         headers:{
//             'X-CSRF-TOKEN': token.value
//         },
//         async : false
//     },
// });


// onSubmit: function () {
//     console.log("hola");
// }

// FilePond.create(document.querySelector('input[name="image[]"]'), {chunkUploads: true});