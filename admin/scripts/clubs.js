let add_club_form = document.getElementById('add_club_form');

    add_club_form.addEventListener('submit',function(e){
        e.preventDefault();
        add_club();
    });

    function add_club()
    {
        let data = new FormData();
        data.append('name',add_club_form.elements['name'].value);
        data.append('desc',add_club_form.elements['desc'].value);
        data.append('purpose',add_club_form.elements['purpose'].value);
        data.append('activities',add_club_form.elements['activities'].value);
        data.append('contribution',add_club_form.elements['contribution'].value);
        data.append('add_club','');

     
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'ajax/clubs.php', true);
       

        xhr.onload = function(){
            var myModal = document.getElementById('add-club');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if(this.responseText == 1){
                alert('success','New club added!');
                add_club_form.reset();
                get_all_clubs();

            }else{
                alert('error','New club failed to add! Try again later');
            }
        }

        xhr.send(data);

    }

    function get_all_clubs()
    {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'ajax/clubs.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
       

        xhr.onload = function(){
            document.getElementById('club-data').innerHTML = this.responseText;

        }

        xhr.send('get_all_clubs'); 
    }

    let edit_club_form = document.getElementById('edit_club_form');
    edit_club_form.addEventListener('submit',function(e){
        e.preventDefault();
        submit_edit_club();
    });
    
    
    function edit_details(id)
    {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'ajax/clubs.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
       

        xhr.onload = function(){
            let data = JSON.parse(this.responseText);

            edit_club_form.elements['name'].value = data.clubdata.name;
            edit_club_form.elements['desc'].value = data.clubdata.desc;
            edit_club_form.elements['purpose'].value = data.clubdata.purpose;
            edit_club_form.elements['activities'].value = data.clubdata.activities;
            edit_club_form.elements['contribution'].value = data.clubdata.contribution;
            edit_club_form.elements['desc'].value = data.clubdata.desc;
            edit_club_form.elements['club_id'].value = data.clubdata.id;      
        }

        xhr.send('get_club='+id);
    }

    function submit_edit_club()
    {
        let data = new FormData();
        data.append('name',edit_club_form.elements['name'].value);
        data.append('desc',edit_club_form.elements['desc'].value);
        data.append('purpose',edit_club_form.elements['purpose'].value);
        data.append('activities',edit_club_form.elements['activities'].value);
        data.append('contribution',edit_club_form.elements['contribution'].value);
        data.append('edit_club','');
        data.append('club_id',edit_club_form.elements['club_id'].value);

     

        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'ajax/clubs.php', true);
       

        xhr.onload = function(){
            var myModal = document.getElementById('edit-club');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if(this.responseText == 1){
                alert('success','Club data updated!');
                edit_club_form.reset();
                get_all_clubs();

            }else{
                alert('error','Club data failed to update! Try again later');
            }
        }

        xhr.send(data);

    }

    

    

    let add_image_form = document.getElementById('add_image_form');

    add_image_form.addEventListener('submit',function(e){
        e.preventDefault();
        add_image();
    });

    function add_image()
    {
        let data = new FormData();
        data.append('image',add_image_form.elements['image'].files[0]);
        data.append('club_id',add_image_form.elements['club_id'].value);
        data.append('add_image','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/clubs.php",true);

        
        xhr.onload = function(){

            if(this.responseText == 'inv_img')
        {
            alert('error','Only JPG, PNG, WEBP AND JPEG images are allowed!','image-alert');
        }
        else if(this.responseText == 'inv_size'){
            alert('error','Image size should be less than 10mb!','image-alert');
        }
        else if(this.responseText == 'upload_failed'){
            alert('error','Image upload failed. Try again later!','image-alert');
        }
        else{
            alert('success','New Club Image added!','image-alert');
            club_images(add_image_form.elements['club_id'].value,document.querySelector("#club-images .modal-title").innerText);
            add_image_form.reset(); 
        }
    }
    xhr.send(data);
    }

    function club_images(id,rname)
    {
        document.querySelector("#club-images .modal-title").innerText = rname;
        add_image_form.elements['club_id'].value = id;
        add_image_form.elements['image'].value = '';

        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'ajax/clubs.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
       

        xhr.onload = function(){
            document.getElementById('club-image-data').innerHTML = this.responseText;

        }

        xhr.send('get_club_images='+id);

    }
    
    function rem_image(img_id,club_id)
    {
        let data = new FormData();
        data.append('image_id',img_id);
        data.append('club_id',club_id);
        data.append('rem_image','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/clubs.php",true);

        
        xhr.onload = function(){

            if(this.responseText == 1)
        {
            alert('success','Club Image Removed!','image-alert');
             club_images(club_id,document.querySelector("#club-images .modal-title").innerText);
        }
        else{
           alert('error','Image removal failed!','image-alert');
        }
    }  

    xhr.send(data);

    }

    function thumb_image(img_id,club_id)
    {
        let data = new FormData();
        data.append('image_id',img_id);
        data.append('club_id',club_id);
        data.append('thumb_image','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/clubs.php",true);

        
        xhr.onload = function(){

            if(this.responseText == 1)
        {
            alert('success','Image Thumbnail Changed!','image-alert');
             club_images(club_id,document.querySelector("#club-images .modal-title").innerText);
        }
        else{
           alert('error','Image Thumbnail changes failed!','image-alert');
        }
    }  

    xhr.send(data);

    }

    function remove_club(club_id)
    {
        if(confirm("Are you sure, you want to delete this club?"))
    {
        let data = new FormData();
        data.append('club_id',club_id);
        data.append('remove_club','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/clubs.php",true);

        
        xhr.onload = function(){

            if(this.responseText == 1)
        {
            alert('success','Club Removed!');
            get_all_clubs();
        }
        else{
           alert('error','Club failed to remove!');
        }
    }  

    xhr.send(data);

    } 
    }
        
        

    window.onload = function()
  {
    get_all_clubs();
   
  }