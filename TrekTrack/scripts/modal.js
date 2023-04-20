
document.addEventListener('DOMContentLoaded', function () {
    const txtNewPostCaption = document.getElementById("new-post-caption");

    const fileNewPostImage = document.getElementById("new-post-image");

    const btnNewPostSubmit = document.getElementById("new-post-submit");

    const btnNewPostCancel = document.getElementsByClassName("modal-cancel")[0];

    const modalNewPost = document.getElementById("modal-new-post");

    const btnNewPostModal = document.getElementById("button-p-new-post");

    const btnFirstPostModal = document.getElementById("button-first-post");

    const imagePreviewContainer = document.getElementById("container-image-preview");

    const labelPostImg = document.getElementById("label-post-image");

    const contPostImg = document.getElementById("post-image-container");

    function gcd(a, b) {
        return (b == 0) ? a : gcd (b, a%b);
    }

    btnNewPostModal.onclick = function () {
        modalNewPost.style.display = "flex";
    };

    btnFirstPostModal.onclick = function () {
        modalNewPost.style.display = "flex";
    };

    function autoResize() {
        this.style.height = 'auto';
        if (this.scrollHeight > 0) {
        this.style.height = (this.scrollHeight) + "px";
        };
    }

    txtNewPostCaption.addEventListener('input', autoResize);
    autoResize.call(txtNewPostCaption);

    function displayImage(imageFile) {
        var reader = new FileReader();

        reader.onload = function (event) {

            var imgElement = document.createElement("img");
            imgElement.src = event.target.result;
            var imgWidth = imgElement.naturalWidth;
            var imgHeight = imgElement.naturalHeight;

            imgElement.setAttribute("id", "img-preview");

            imgElement.style.width = "38em";
            imgElement.style.height = "auto";
            imgElement.style.maxWidth = "100%"; 
            imgElement.style.maxHeight = "60em";
            
            imgElement.style.borderRadius = "10px"
            
            contPostImg.style.width = "auto";
            contPostImg.style.height = "auto";
            contPostImg.style.padding = "0";
            contPostImg.style.marginInline = "auto";

            contPostImg.removeChild(contPostImg.childNodes[contPostImg.childNodes.length - 1]);
            labelPostImg.remove();

            contPostImg.appendChild(imgElement);

            $('#img-preview').on('click', function() {
                $('#new-post-image').trigger('click');
            });
        };

        reader.readAsDataURL(imageFile);
    }

    fileNewPostImage.addEventListener('change', function () {

        if (this.files && this.files.length > 0) {
            displayImage(this.files[0]);
        }
    });

});

