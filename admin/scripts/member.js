let place_s_form = document.getElementById('place_s_form');

    place_s_form.addEventListener('submit',function(e){
        e.preventDefault();
        add_member();
    });

    function add_member()
    {
        let data = new FormData();
        data.append('name',place_s_form.elements['member_name'].value);
        data.append('picture',place_s_form.elements['member_picture'].files[0]);
        data.append('email',place_s_form.elements['member_email'].value);
        data.append('phoneno',place_s_form.elements['member_phoneno'].value);
        data.append('class',place_s_form.elements['member_class'].value);
        data.append('add_member','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/member.php",true);

        xhr.onload = function(){
            var myModal = document.getElementById('place-s');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if(this.responseText == 'inv_img'){
                alert('error','Only JPG, JPEG, PNG AND WEBP images are allowed!');
            }
            else if(this.responseText == 'inv_size'){
                alert('error','Image should be less than 1MB!');
            }
            else if(this.responseText == 'upload_failed')
            {
                alert('error','Image upload failed. Server Down!');
            }else{
                alert('success','New Member added!');
                place_s_form.reset();
                get_member();


            }
        }
        xhr.send(data);
    }

    function get_member()
    {
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/member.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
            document.getElementById('member-data').innerHTML = this.responseText;
        }
        xhr.send('get_member')
    }

    

    function rem_member(val)
    {
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/member.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        xhr.onload = function(){
            if(this.responseText==1){
                alert('success','Member removed');
                get_member();
            }
            else{
                alert('error','Member Failed to remove! Try again');
            }
        }
           
        
        xhr.send('rem_member='+val);
    }

        window.onload = function(){
            get_member();


    }