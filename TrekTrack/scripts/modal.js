import { autoResize, removeWhiteSpace, preventEnterKey } from './util.js';

document.addEventListener('DOMContentLoaded', function () {
    const txtNewPostCaption = document.getElementById("new-post-caption");

    const fileNewPostImage = document.getElementById("new-post-image");

    const btnNewPostSubmit = document.getElementById("button-new-post-submit");

    const btnNewPostCancel = document.getElementsByClassName("modal-close")[0];

    const modalNewPost = document.getElementById("modal-new-post");

    const btnNewPostModal = document.getElementById("button-p-new-post");

    const btnFirstPostModal = document.getElementById("button-first-post");

    const imagePreviewContainer = document.getElementById("container-image-preview");

    const labelPostImg = document.getElementById("label-post-image");

    const contPostImg = document.getElementById("post-image-container");


    btnNewPostModal.onclick = function () {
        modalNewPost.style.display = "flex";
        autoResize.call(txtNewPostCaption);
    };

    btnFirstPostModal.onclick = function () {
        modalNewPost.style.display = "flex";
        autoResize.call(txtNewPostCaption);
    };

    btnNewPostCancel.onclick = function () {
        $('#img-preview').remove();
        labelPostImg.style.display = "block";
        contPostImg.style.paddingInline = "1em";
        contPostImg.style.paddingBlock = "2em";
        modalNewPost.style.display = "none";
    };

    txtNewPostCaption.addEventListener('input', autoResize);
    txtNewPostCaption.addEventListener('focus', autoResize);
    txtNewPostCaption.addEventListener('blur', autoResize);
    
    txtNewPostCaption.addEventListener('blur', removeWhiteSpace);
    txtNewPostCaption.addEventListener('focus', removeWhiteSpace);
    txtNewPostCaption.addEventListener('keydown', preventEnterKey);

    window.addEventListener('resize', function () {
        autoResize.call(txtNewPostCaption);
    });
    
    autoResize.call(txtNewPostCaption);
    

    function displayImage(imageFile) {
        let reader = new FileReader();

        reader.onload = function (event) {

            let imgElement = document.createElement("img");
            imgElement.src = event.target.result;

            imgElement.setAttribute("id", "img-preview");

            imgElement.style.width = "38em";
            imgElement.style.height = "auto";
            imgElement.style.maxWidth = "100%"; 
            imgElement.style.maxHeight = "60em";
            
            imgElement.style.borderRadius = "5px"
            
            contPostImg.style.width = "auto";
            contPostImg.style.height = "auto";
            contPostImg.style.padding = "0";
            contPostImg.style.marginInline = "auto";

            $('#img-preview').remove();
            
            labelPostImg.style.display = "none";

            contPostImg.appendChild(imgElement);

            $('#img-preview').on('click', function() {
                $('#new-post-image').trigger('click');
            });
        };

        reader.readAsDataURL(imageFile);
        autoResize.call(txtNewPostCaption);
    }

    fileNewPostImage.addEventListener('change', function () {

        autoResize.call(txtNewPostCaption);
        btnNewPostSubmit.setAttribute("type", "submit");

        if (this.files && this.files.length > 0) {
            displayImage(this.files[0]);
        }
    });

    txtNewPostCaption.addEventListener('input', function () {
        btnNewPostSubmit.setAttribute("type", "submit");
    });
    
});

