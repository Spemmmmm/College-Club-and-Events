let event_s_form = document.getElementById('event_s_form');

    event_s_form.addEventListener('submit',function(e){
        e.preventDefault();
        add_event();
    });

    function add_event()
    {
        let data = new FormData();
        data.append('name',event_s_form.elements['name'].value);
        data.append('picture',event_s_form.elements['picture'].files[0]);
        data.append('desc',event_s_form.elements['description'].value);
        data.append('dateofevent',event_s_form.elements['date'].value);
        data.append('add_event','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/events.php",true);

        xhr.onload = function(){
            var myModal = document.getElementById('event-s');
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
                alert('success','New event added!');
                event_s_form.reset();
                get_event();


            }
        }
        xhr.send(data);
    }

    function get_event()
    {
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/events.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
            document.getElementById('event-data').innerHTML = this.responseText;
        }
        xhr.send('get_event')
    }

    
    

    function rem_event(val)
    {
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/events.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        xhr.onload = function(){
            if(this.responseText==1){
                alert('success','Event removed');
                get_event();
            }
            else{
                alert('error','Event Failed to remove! Try again');
            }
        }
           
        
        xhr.send('rem_event='+val);
    }

        window.onload = function(){
            get_event();

    }