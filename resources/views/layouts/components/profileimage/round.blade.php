@if(!empty($profileData['filename']))
    @php
        $basePath   =   $profileData['base_path'];
        $uuid       =   $profileData['uuid'];
        $category   =   $profileData['category'];
        $filename   =   $profileData['filename'];
        $extension  =   $profileData['extension'];
        $url        =   $basePath.$uuid."/".$category."/".$filename.$extension;

    @endphp

    <img src="../".{{$url}} class="rounded-circle img-thumbnail avatar-xl" alt="profile-image">
@else
    <img src="../public/assets/images/user-male.png" class="rounded-circle img-thumbnail avatar-xl" alt="profile-image">

@endif
