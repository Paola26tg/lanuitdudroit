/**
 * Account Settings - Account
 */

'use strict';

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const deactivateAcc = document.querySelector('#formAccountDeactivation');
    const uploads = document.querySelectorAll('.imgUpload');
   
    // Update/reset user image of account page
    if(uploads){
    uploads.forEach((upload) => {
       const uploadId = upload.dataset.id;
    let accountUserImage = document.getElementById('uploadedAvatar-'+uploadId);
    const fileInput = document.querySelector('#upload'+uploadId);
      const resetFileInput = document.querySelector('.account-image-reset'+uploadId);
      console.log(uploadId);
    if (accountUserImage) {
      const resetImage = accountUserImage.src;
      fileInput.onchange = () => {
        if (fileInput.files[0]) {
          accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
           console.log(fileInput.files[0]);
        }
       
      };
      resetFileInput.onclick = () => {
        fileInput.value = '';
        accountUserImage.src = resetImage;
      };
    }
  })
  }
      let accountUserImage1 = document.getElementById('uploadedAvatar');
      const fileInput1 = document.querySelector('.account-file-input'),
        resetFileInput1 = document.querySelector('.account-image-reset');

      if (accountUserImage1) {
        const resetImage1 = accountUserImage1.src;
        fileInput1.onchange = () => {
          if (fileInput1.files[0]) {
            accountUserImage1.src = window.URL.createObjectURL(
              fileInput1.files[0],
            );
            console.log(fileInput1.files[0]);
          }
        };
        resetFileInput1.onclick = () => {
          fileInput1.value = '';
          accountUserImage1.src = resetImage1;
        };
      }
    
  })();
});
 
