<a href="" target="_blank">
    <style>
        .logo {
            height: 50px;
            /* width: 50px;
            border-radius: 50%; */
            border-radius: 6px;
            object-fit: cover;
            border: 1px solid #ccc;
        }
    </style>
    {!!  get_upload_file($item->images[0], false, 'sm', 'logo') !!}
</a>
