<?php 
    include 'database-connection.php';
    //include 'mail.php';
    session_start();
    ob_start();

if (isset($_POST['signin']))
{
    $username = htmlspecialchars(trim( $_POST['user_name']));
    $password = htmlspecialchars(trim( $_POST['user_pass']));

    if ($username && $password)
    {

        $user = $conn->prepare("SELECT * FROM users WHERE user_name=:user_name AND password=:password");
        $user->execute(array(
            'user_name'=> $username,
            'password'=>$password
        ));

        $getUser = $user->fetch(PDO::FETCH_ASSOC);
        $loginUser = $user->rowCount();

        if ($loginUser)
        {
            $_SESSION['user_id'] = $getUser['user_id'];
            header('Location: ../data/index.php');
        }
        else
        {
            header('Location: ../data/login.php?status=no');
        }

    }
    else
        header('Location: ../data/login.php?status=no');
}

//author-add
elseif(isset($_POST['authorsave']))
{
    // filter
    $nameSurname = htmlspecialchars($_POST['nameSurname']);
    $authority = htmlspecialchars(filter_var($_POST['authority'], FILTER_VALIDATE_INT));
    $category = htmlspecialchars($_POST['category']);   
    $phone = preg_replace('/[^0-9]/', '', htmlspecialchars($_POST["phone"]));
    //$phone = htmlspecialchars($_POST["phone"]);
    $email = filter_var(htmlspecialchars($_POST["email"]), FILTER_VALIDATE_EMAIL);

    // image upload
    $upload_dir = '../assets/img/author';
    $tmp_name = $_FILES['images']["tmp_name"];
    $name = $_FILES['images']["name"];

    $num1 = rand(2000,3200);
    $num2= rand(2000,3200);
    $num3= rand(2000,3200);
    $num4= rand(2000,3200);

    $number = $num1.$num2.$num3.$num4;
    $image_way = substr($upload_dir,21)."/".$number.$name;

    move_uploaded_file($tmp_name,"$upload_dir/$number$name");

    // database operations
    $query = $conn->prepare("INSERT INTO author SET
        author_image=:images,
        author_name_surname=:nameSurname,
        author_authority=:authority,
        author_category=:category,
        author_phone=:phone,
        author_mail=:email
    ");
   
    $insert = $query->execute(array(
        'images'=>$image_way,
        'nameSurname'=>$nameSurname,
        'authority'=>$authority,
        'category'=>$category,
        'phone'=>$phone,
        'email'=>$email
    ));

    if($insert)
    {
        header('Location: ../data/author.php?status=yes');
    }
    else
        header('Location: ../data/author.php?status=no');
}
// author edit
elseif(isset($_POST['authoredit'])) 
{
    // filter
    $nameSurname = htmlspecialchars($_POST['nameSurname']);
    $authority = htmlspecialchars(filter_var($_POST['authority'], FILTER_VALIDATE_INT));
    $category = htmlspecialchars($_POST['category']);   
    $phone = preg_replace('/[^0-9]/', '', htmlspecialchars($_POST["phone"]));
    $email = filter_var(htmlspecialchars($_POST["email"]), FILTER_VALIDATE_EMAIL);
    $id = $_POST['id'];
    $img = $_POST['author_img'];

    if($_FILES['images']['tmp_name'])
    {
        
        // image upload
        $upload_dir = '../assets/img/author';
        $tmp_name = $_FILES['images']["tmp_name"];
        $name = $_FILES['images']["name"];

        $num1 = rand(2000,3200);
        $num2= rand(2000,3200);
        $num3= rand(2000,3200);
        $num4= rand(2000,3200);

        $number = $num1.$num2.$num3.$num4;
        $image_way = substr($upload_dir,21)."/".$number.$name;

        move_uploaded_file($tmp_name,"$upload_dir/$number$name");

        // database operations
        $query = $conn->prepare("UPDATE author SET
            author_image=:images,
            author_name_surname=:nameSurname,
            author_authority=:authority,
            author_category=:category,
            author_phone=:phone,
            author_mail=:email
            WHERE author_id={$_POST['id']}
        ");
    
        $update = $query->execute(array(
            'images'=>$image_way,
            'nameSurname'=>$nameSurname,
            'authority'=>$authority,
            'category'=>$category,
            'phone'=>$phone,
            'email'=>$email
        ));

        if($update)
        {
            unlink('../assets/img/author/'.$img);
            header('Location: ../data/author-display.php?id='.$id);
        }
        else
        {
            header('Location: ../data/author.php?status=no');
        }
    }
    else
    {
        $query = $conn->prepare("UPDATE author SET
            author_name_surname=:nameSurname,
            author_authority=:authority,
            author_category=:category,
            author_phone=:phone,
            author_mail=:email
            WHERE author_id={$_POST[id]}
        ");

        $update = $query->execute(array(
            'nameSurname'=>$nameSurname,
            'authority'=>$authority,
            'category'=>$category,
            'phone'=>$phone,
            'email'=>$email
        ));
        if($update)
        {
            header('Location: ../data/author-display.php?id='.$id);
        }
        else
        {
            header('Location: ../data/author.php?status=no');
        }
    }

}

elseif(isset($_POST['authorremove']))
{
    $img = $_POST['author_img'];

    $remove = $conn->prepare("DELETE FROM author WHERE author_id=:id");
    $remove->execute(array(
        'id'=>$_POST['id']
    ));
    
    if($remove)
    {
        unlink('../assets/img/author/'.$img);
        header('Location: ../data/author.php?status=yes');
    }
    else
    {
        header('Location: ../data/author.php?status=no');
    }
}

elseif(isset($_POST['settingssave']))
{
        // filter
        $title = htmlspecialchars($_POST['title']);
        $keywords = htmlspecialchars($_POST['keywords']); 
        $author = htmlspecialchars($_POST['author']);
        $Descriptionn = htmlspecialchars($_POST['description']);
        $urll = htmlspecialchars($_POST['url']);
        if($_FILES['logo']["name"])
        {
            $upload_dir = '../assets/img/logo';
            $tmp_name = $_FILES['logo']["tmp_name"];
            $name = $_FILES['logo']["name"];

            $num1 = rand(2000,3200);
            $num2= rand(2000,3200);
            $num3= rand(2000,3200);
            $num4= rand(2000,3200);
    
            $number = $num1.$num2.$num3.$num4;
            $image_way = substr($upload_dir,19)."/".$number.$name;
    
            move_uploaded_file($tmp_name,"$upload_dir/$number$name");
           
            // database operations
            $query = $conn->prepare("UPDATE settings SET
                setting_logo =:images,
                setting_title =:title,
                setting_keywords =:keywords,
                setting_author =:author,
                setting_description =:Descriptionn,
                site_url =:urll
            ");
            $update = $query->execute(array(
                'images'=>$image_way,
                'title'=>$title,
                'keywords'=>$keywords,
                'author'=>$author,
                'Descriptionn'=>$Descriptionn,
                'urll'=>$urll
            ));
    
            if($update)
            {            
                header('Location: ../data/index.php?status=yes');
            }
            else
            {
                header('Location: ../data/index.php?status=no');
            } 
        }
        else
        {
            // database operations
            $query = $conn->prepare("UPDATE settings SET
            setting_title =:title,
            setting_keywords =:keywords,
            setting_author =:author,
            setting_description =:Descriptionn,
            site_url =:urll
            ");

            $update = $query->execute(array(
            'title'=>$title,
            'keywords'=>$keywords,
            'author'=>$author,
            'Descriptionn'=>$Descriptionn,
            'urll'=>$urll
            ));

            if($update)
            {            
                header('Location: ../data/index.php?status=yes');
            }
            else
            {
                header('Location: ../data/index.php?status=no');
            } 
        }     
}

elseif(isset($_POST['contactsave'])) 
{
    // filter
    $adress = htmlspecialchars($_POST['adress']);
    $fax = htmlspecialchars($_POST['fax']);   
    $phone =htmlspecialchars($_POST["phone"]);
    $phone2 = htmlspecialchars($_POST["phone2"]);
    $email = filter_var(htmlspecialchars($_POST["email"]), FILTER_VALIDATE_EMAIL);

    $query = $conn->prepare("INSERT INTO contact SET
        contact_email =:email,
        contact_fax =:fax,
        contact_phone =:phone,
        contact_phone2 =:phone2,
        contact_adress =:adress
    ");
    $insert = $query->execute(array(
        'email'=>$email,
        'fax'=>$fax,
        'phone'=>$phone,
        'phone2'=>$phone2,
        'adress'=>$adress
    ));
    
    if($insert)
    {
        header('Location: ../data/index.php?status=yes');
    }
    else
    {
        header('Location: ../data/contact.php?status=no');
    }
}

elseif(isset($_POST['socailmediasave']))
{
    $face = htmlspecialchars(trim($_POST['facebook']));
    $twitter = htmlspecialchars(trim($_POST['twitter']));
    $linkedin = htmlspecialchars(trim($_POST['linkedin']));
    $instagram = htmlspecialchars(trim($_POST['instagram']));
    $gplus = htmlspecialchars(trim($_POST['gplus']));
    $youtube = htmlspecialchars(trim($_POST['youtube']));
    $github = htmlspecialchars(trim($_POST['github']));
    $pinterest = htmlspecialchars(trim($_POST['pinterest']));

    $query = $conn->prepare("INSERT INTO social_media SET
        social_face =:face,
        social_twitter =:twitter,
        social_linkedin =:linkedin,
        social_instagram =:instagram,
        social_gplus =:gplus,
        social_youtube =:youtube,
        social_github =:github,
        social_pinterest =:pinterest
    ");

    $insert = $query->execute(array(
        'face'=>$face,
        'twitter'=>$twitter,
        'linkedin'=>$linkedin,
        'instagram'=>$instagram,
        'gplus'=>$gplus,
        'youtube'=>$youtube,
        'github'=>$github,
        'pinterest'=>$pinterest
    ));

    if($insert)
    {
        header('Location: ../data/index.php?status=yes');
    }
    else
    {
        header('Location: ../data/contact.php?status=no');
    }
}

elseif(isset($_POST['agendasave']))
{
    $title = htmlspecialchars(trim($_POST['title']));
    $subjectt = htmlspecialchars(trim($_POST['subject']));
    $keywords = htmlspecialchars(trim($_POST['keywords']));
    $author_id = htmlspecialchars(trim($_POST['author_id']));
    $content = $_POST['content'];
    $upload_dir = '../assets/img/agenda';
    $tmp_name = $_FILES['images']["tmp_name"];
    $name = $_FILES['images']["name"];

    $num1 = rand(2000,3200);
    $num2= rand(2000,3200);
    $num3= rand(2000,3200);
    $num4= rand(2000,3200);
    
    $number = $num1.$num2.$num3.$num4;
    $image_way = substr($upload_dir,25)."/".$number.$name;
    
    move_uploaded_file($tmp_name,"$upload_dir/$number$name");

    $query = $conn->prepare("INSERT INTO agenda SET
        author_id=:id,
        agenda_title=:title,
        agenda_keywords=:keywords,
        agenda_subject=:subjectt,
        agenda_content=:content,
        agenda_bgimage=:images
    ");

    $setQuery = $query->execute(array(
        'id'=>$author_id,
        'title'=>$title,
        'keywords'=>$keywords,
        'subjectt'=>$subjectt,
        'content'=>$content,
        'images'=>$image_way
    ));
    if($setQuery)
    {       
        header('Location: ../data/category-agenda.php?status=yes');
    }
    else
    {
        header('Location: ../data/category-agenda.php?status=no');
    }
}

elseif(isset($_POST['agendaedit']))
{
    $title = htmlspecialchars(trim($_POST['title']));
    $subjectt = htmlspecialchars(trim($_POST['subject']));
    $keywords = htmlspecialchars(trim($_POST['keywords']));
    $author_id = htmlspecialchars(trim($_POST['author_id']));
    $content = $_POST['content'];
    $id = $_POST['agenda_id'];
    $img = $_POST['agenda_img'];

    if($_FILES['images']['tmp_name'])
    {
        $upload_dir = '../assets/img/agenda';
        $tmp_name = $_FILES['images']["tmp_name"];
        $name = $_FILES['images']["name"];

        $num1 = rand(2000,3200);
        $num2= rand(2000,3200);
        $num3= rand(2000,3200);
        $num4= rand(2000,3200);

        $number = $num1.$num2.$num3.$num4;
        $image_way = substr($upload_dir,25)."/".$number.$name;

        move_uploaded_file($tmp_name,"$upload_dir/$number$name");

        $query = $conn->prepare("UPDATE agenda SET
            agenda_title=:title,
            agenda_keywords=:keywords,
            agenda_subject=:subjectt,
            agenda_content=:content,
            agenda_bgimage=:images
            WHERE agenda_id={$id}
        ");

        $setQuery = $query->execute(array(
            'id'=>$author_id,
            'title'=>$title,
            'keywords'=>$keywords,
            'subjectt'=>$subjectt,
            'content'=>$content,
            'images'=>$image_way
        ));
        if($setQuery)
        {
            unlink('../assets/img/agenda/'.$img);
            header('Location: ../data/agenda-display.php?id='.$id);
        }
        else
        {
            header('Location: ../data/agenda.php?id='.$id.'&&status=no');
        }
    }
    $query = $conn->prepare("UPDATE agenda SET
        author_id=:id,
        agenda_title=:title,
        agenda_keywords=:keywords,
        agenda_subject=:subjectt,
        agenda_content=:content
        WHERE agenda_id={$id}
    ");

    $setQuery = $query->execute(array(
        'id'=>$author_id,
        'title'=>$title,
        'keywords'=>$keywords,
        'subjectt'=>$subjectt,
        'content'=>$content
    ));
    if($setQuery)
    {
        header('Location: ../data/agenda-display.php?id='.$id);
    }
    else
    {
        header('Location: ../data/agenda.php?id='.$id.'&&status=no');
    }
}

elseif(isset($_POST['agendaremove']))
{
    $img = $_POST['agenda_img'];

    $remove = $conn->prepare("DELETE FROM agenda WHERE agenda_id=:id");
    $remove->execute(array(
        'id'=>$_POST['id']
    ));

    if($remove)
    {
        unlink('../assets/img/agenda/'.$img);
        header('Location: ../data/category-agenda.php?status=yes');
    }
    else
    {
        header('Location: ../data/category-agenda.php?status=no');
    }
}

elseif(isset($_POST['agendacancel']))
{
    header('Location: ../data/category-agenda.php');
}

elseif(isset($_POST['technologyasave']))
{
    $title = htmlspecialchars(trim($_POST['technologytitle']));
    $subjectt = htmlspecialchars(trim($_POST['technologysubject']));
    $keywords = htmlspecialchars(trim($_POST['technologykeywords']));
    $author_id = htmlspecialchars(trim($_POST['author_id']));
    $content = $_POST['technologycontent'];

    $upload_dir = '../assets/img/technology';
    $tmp_name = $_FILES['technologyimages']["tmp_name"];
    $name = $_FILES['technologyimages']["name"];

    $num1 = rand(2000,3200);
    $num2= rand(2000,3200);
    $num3= rand(2000,3200);
    $num4= rand(2000,3200);

    $number = $num1.$num2.$num3.$num4;
    $image_way = substr($upload_dir,29)."/".$number.$name;

    move_uploaded_file($tmp_name,"$upload_dir/$number$name");

    $query = $conn->prepare("INSERT INTO technology SET
        author_id=:id,
        technology_title=:title,
        technology_keywords=:keywords,
        technology_subject=:subjectt,
        technology_content=:content,
        technology_bgimage=:images
    ");

    $setQuery = $query->execute(array(
        'id'=>$author_id,
        'title'=>$title,
        'keywords'=>$keywords,
        'subjectt'=>$subjectt,
        'content'=>$content,
        'images'=>$image_way
    ));

    if($setQuery)
    {
        header('Location: ../data/category-technology.php?status=yes');
    }
    else
    {
        header('Location: ../data/category-technology.php?status=no');
    }
}

elseif(isset($_POST['technologyedit']))
{
    $title = htmlspecialchars(trim($_POST['technologytitle']));
    $subjectt = htmlspecialchars(trim($_POST['technologysubject']));
    $keywords = htmlspecialchars(trim($_POST['technologykeywords']));
    $author_id = htmlspecialchars(trim($_POST['author_id']));
    $content = $_POST['technologycontent'];
    $id = $_POST['technology_id'];

    if($_FILES['technologyimages']['tmp_name'])
    {
        $upload_dir = '../assets/img/technology';
        $tmp_name = $_FILES['technologyimages']["tmp_name"];
        $name = $_FILES['technologyimages']["name"];

        $num1 = rand(2000,3200);
        $num2= rand(2000,3200);
        $num3= rand(2000,3200);
        $num4= rand(2000,3200);

        $number = $num1.$num2.$num3.$num4;
        $image_way = substr($upload_dir,29)."/".$number.$name;

        move_uploaded_file($tmp_name,"$upload_dir/$number$name");

        $query = $conn->prepare("UPDATE technology SET        
            author_id=:id,
            technology_title=:title,
            technology_keywords=:keywords,
            technology_subject=:subjectt,
            technology_content=:content,
            technology_bgimage=:images
            WHERE technology_id={$id}
        ");

        $setQuery = $query->execute(array(
            'id'=>$author_id,
            'title'=>$title,
            'keywords'=>$keywords,
            'subjectt'=>$subjectt,
            'content'=>$content,
            'images'=>$image_way
        ));
        if($setQuery)
        {
            header('Location: ../data/technology-display.php?id='.$id);
        }
        else
        {
            header('Location: ../data/technology.php?id='.$id.'&&status=no');
        }
    }
    $query = $conn->prepare("UPDATE technology SET
            author_id=:id,
            technology_title=:title,
            technology_keywords=:keywords,
            technology_subject=:subjectt,
            technology_content=:content
            WHERE technology_id={$id}
    ");

    $setQuery = $query->execute(array(
        'id'=>$author_id,
        'title'=>$title,
        'keywords'=>$keywords,
        'subjectt'=>$subjectt,
        'content'=>$content
    ));

    if($setQuery)
    {
        header('Location: ../data/technology-display.php?id='.$id);
    }
    else
    {
        header('Location: ../data/technology.php?id='.$id.'&&status=no');
    }
}

elseif(isset($_POST['technologyremove']))
{
    $img = $_POST['bg_name'];

    $remove = $conn->prepare("DELETE FROM technology WHERE technology_id=:id");
    $remove->execute(array(
        'id'=>$_POST['id']
    ));

    if($remove)
    {
        unlink('../assets/img/technology/'.$img);
        header('Location: ../data/category-technology.php?status=yes');
    }
    else
    {
        header('Location: ../data/category-technology.php?status=no');
    }
}

elseif(isset($_POST['technologycancel']))
{
    header('Location: ../data/category-technology.php');
}

elseif(isset($_POST['literaturesave']))
{
    $title = htmlspecialchars(trim($_POST['literaturetitle']));
    $subjectt = htmlspecialchars(trim($_POST['literaturesubject']));
    $keywords = htmlspecialchars(trim($_POST['literaturekeywords']));
    $author_id = htmlspecialchars(trim($_POST['author_id']));
    $content = $_POST['literaturecontent'];

    $upload_dir = '../assets/img/literature';
    $tmp_name = $_FILES['literatureimages']["tmp_name"];
    $name = $_FILES['literatureimages']["name"];

    $num1 = rand(2000,3200);
    $num2= rand(2000,3200);
    $num3= rand(2000,3200);
    $num4= rand(2000,3200);

    $number = $num1.$num2.$num3.$num4;
    $image_way = substr($upload_dir,30)."/".$number.$name;

    move_uploaded_file($tmp_name,"$upload_dir/$number$name");

    $query = $conn->prepare("INSERT INTO literature SET
        author_id=:id,
        literature_title=:title,
        literature_keywords=:keywords,
        literature_subject=:subjectt,
        literature_content=:content,
        literature_bgimage=:images
    ");

    $setQuery = $query->execute(array(
        'id'=>$author_id,
        'title'=>$title,
        'keywords'=>$keywords,
        'subjectt'=>$subjectt,
        'content'=>$content,
        'images'=>$image_way
    ));

    if($setQuery)
    {
        header('Location: ../data/category-literature.php?status=yes');
    }
    else
    {
        header('Location: ../data/category-literature.php?status=no');
    }
}

elseif(isset($_POST['literatureedit']))
{
    $title = htmlspecialchars(trim($_POST['literaturetitle']));
    $subjectt = htmlspecialchars(trim($_POST['literaturesubject']));
    $keywords = htmlspecialchars(trim($_POST['literaturekeywords']));
    $author_id = htmlspecialchars(trim($_POST['author_id']));
    $content = $_POST['literaturecontent'];
    $id = $_POST['literature_id'];

    if($_FILES['literatureimages']['tmp_name'])
    {
        $upload_dir = '../assets/img/literature';
        $tmp_name = $_FILES['literatureimages']["tmp_name"];
        $name = $_FILES['literatureimages']["name"];

        $num1 = rand(2000,3200);
        $num2= rand(2000,3200);
        $num3= rand(2000,3200);
        $num4= rand(2000,3200);

        $number = $num1.$num2.$num3.$num4;
        $image_way = substr($upload_dir,30)."/".$number.$name;

        move_uploaded_file($tmp_name,"$upload_dir/$number$name");

        $query = $conn->prepare("UPDATE literature SET        
            author_id=:id,
            literature_title=:title,
            literature_keywords=:keywords,
            literature_subject=:subjectt,
            literature_content=:content,
            literature_bgimage=:images
            WHERE literature_id={$id}
        ");

        $setQuery = $query->execute(array(
            'id'=>$author_id,
            'title'=>$title,
            'keywords'=>$keywords,
            'subjectt'=>$subjectt,
            'content'=>$content,
            'images'=>$image_way
        ));
        if($setQuery)
        {
            header('Location: ../data/literature-display.php?id='.$id);
        }
        else
        {
            header('Location: ../data/literature.php?id='.$id.'&&status=no');
        }
    }
    $query = $conn->prepare("UPDATE literature SET
            author_id=:id,
            literature_title=:title,
            literature_keywords=:keywords,
            literature_subject=:subjectt,
            literature_content=:content
            WHERE literature_id={$id}
    ");

    $setQuery = $query->execute(array(
        'id'=>$author_id,
        'title'=>$title,
        'keywords'=>$keywords,
        'subjectt'=>$subjectt,
        'content'=>$content
    ));

    if($setQuery)
    {
        header('Location: ../data/literature-display.php?id='.$id);
    }
    else
    {
        header('Location: ../data/literature.php?id='.$id.'&&status=no');
    }
}

elseif(isset($_POST['literatureremove']))
{
    $img = $_POST['bg_name'];

    $remove = $conn->prepare("DELETE FROM literature WHERE literature_id=:id");
    $remove->execute(array(
        'id'=>$_POST['id']
    ));

    if($remove)
    {
        unlink('../assets/img/literature/'.$img);
        header('Location: ../data/category-literature.php?status=yes');
    }
    else
    {
        header('Location: ../data/category-literature.php?status=no');
    }
}

elseif(isset($_POST['literaturecancel']))
{
    header('Location: ../data/category-literature.php');
}

elseif(isset($_POST['travelsave']))
{
    $title = htmlspecialchars(trim($_POST['traveltitle']));
    $subjectt = htmlspecialchars(trim($_POST['travelsubject']));
    $keywords = htmlspecialchars(trim($_POST['travelkeywords']));
    $author_id = htmlspecialchars(trim($_POST['author_id']));
    $content = $_POST['travelcontent'];
    $id = htmlspecialchars(trim($_POST['travel_id']));
    $upload_dir = '../assets/img/travel';
    $tmp_name = $_FILES['travelimages']["tmp_name"];
    $name = $_FILES['travelimages']["name"];

    $num1 = rand(2000,3200);
    $num2= rand(2000,3200);
    $num3= rand(2000,3200);
    $num4= rand(2000,3200);

    $number = $num1.$num2.$num3.$num4;
    $image_way = substr($upload_dir,26)."/".$number.$name;

    move_uploaded_file($tmp_name,"$upload_dir/$number$name");

    $query = $conn->prepare("INSERT INTO travel SET
        author_id=:id,
        travel_title=:title,
        travel_keywords=:keywords,
        travel_subject=:subjectt,
        travel_content=:content,
        travel_bgimage=:images
    ");

    $setQuery = $query->execute(array(
        'id'=>$author_id,
        'title'=>$title,
        'keywords'=>$keywords,
        'subjectt'=>$subjectt,
        'content'=>$content,
        'images'=>$image_way
    ));

    if($setQuery)
    {
        header('Location: ../data/category-travel.php?status=yes');
    }
    else
    {
        header('Location: ../data/category-travel.php?status=no');
    }
}

elseif(isset($_POST['traveledit']))
{
    $title = htmlspecialchars(trim($_POST['traveltitle']));
    $subjectt = htmlspecialchars(trim($_POST['travelsubject']));
    $keywords = htmlspecialchars(trim($_POST['travelkeywords']));
    $author_id = htmlspecialchars(trim($_POST['author_id']));
    $content = $_POST['travelcontent'];
    $id = $_POST['travel_id'];

    if($_FILES['travelimages']['tmp_name'])
    {
        $upload_dir = '../assets/img/travel';
        $tmp_name = $_FILES['travelimages']["tmp_name"];
        $name = $_FILES['travelimages']["name"];

        $num1 = rand(2000,3200);
        $num2= rand(2000,3200);
        $num3= rand(2000,3200);
        $num4= rand(2000,3200);

        $number = $num1.$num2.$num3.$num4;
        $image_way = substr($upload_dir,30)."/".$number.$name;

        move_uploaded_file($tmp_name,"$upload_dir/$number$name");

        $query = $conn->prepare("UPDATE travel SET        
            author_id=:id,
            travel_title=:title,
            travel_keywords=:keywords,
            travel_subject=:subjectt,
            travel_content=:content,
            travel_bgimage=:images
            WHERE travel_id={$id}
        ");

        $setQuery = $query->execute(array(
            'id'=>$author_id,
            'title'=>$title,
            'keywords'=>$keywords,
            'subjectt'=>$subjectt,
            'content'=>$content,
            'images'=>$image_way
        ));
        if($setQuery)
        {
            header('Location: ../data/travel-display.php?id='.$id);
        }
        else
        {
            header('Location: ../data/travel.php?id='.$id.'&&status=no');
        }
    }
    $query = $conn->prepare("UPDATE travel SET
            author_id=:id,
            travel_title=:title,
            travel_keywords=:keywords,
            travel_subject=:subjectt,
            travel_content=:content
            WHERE travel_id={$id}
    ");

    $setQuery = $query->execute(array(
        'id'=>$author_id,
        'title'=>$title,
        'keywords'=>$keywords,
        'subjectt'=>$subjectt,
        'content'=>$content
    ));

    if($setQuery)
    {
        header('Location: ../data/travel-display.php?id='.$id);
    }
    else
    {
        header('Location: ../data/travel.php?id='.$id.'&&status=no');
    }
}

elseif(isset($_POST['travelremove']))
{
    $img = $_POST['bg_name'];

    $remove = $conn->prepare("DELETE FROM travel WHERE travel_id=:id");
    $remove->execute(array(
        'id'=>$_POST['id']
    ));

    if($remove)
    {
        unlink('../assets/img/travel/'.$img);
        header('Location: ../data/category-travel.php?status=yes');
    }
    else
    {
        header('Location: ../data/category-travel.php?status=no');
    }
}

elseif(isset($_POST['travelcancel']))
{
    header('Location: ../data/category-travel.php');
}

elseif(isset($_POST['healthLifesave']))
{
    $title = htmlspecialchars(trim($_POST['healthLifetitle']));
    $subjectt = htmlspecialchars(trim($_POST['healthLifesubject']));
    $keywords = htmlspecialchars(trim($_POST['healthLifekeywords']));
    $author_id = htmlspecialchars(trim($_POST['author_id']));
    $content = $_POST['healthLifecontent'];
    /*echo "<br>".$title."<br>".$subjectt."<br>".$keywords"<br>".$author_id."<br>".$content"<br>";
    exit();*/
    $upload_dir = '../assets/img/healthLife';
    $tmp_name = $_FILES['healthLifeimages']["tmp_name"];
    $name = $_FILES['healthLifeimages']["name"];

    $num1 = rand(2000,3200);
    $num2= rand(2000,3200);
    $num3= rand(2000,3200);
    $num4= rand(2000,3200);

    $number = $num1.$num2.$num3.$num4;
    $image_way = substr($upload_dir,30)."/".$number.$name;

    move_uploaded_file($tmp_name,"$upload_dir/$number$name");

    $query = $conn->prepare("INSERT INTO healt_life SET
        author_id=:id,
        healthLife_title=:title,
        healthLife_keywords=:keywords,
        healthLife_subject=:subjectt,
        healthLife_content=:content,
        healthLife_bgimage=:images
    ");

    $setQuery = $query->execute(array(
        'id'=>$author_id,
        'title'=>$title,
        'keywords'=>$keywords,
        'subjectt'=>$subjectt,
        'content'=>$content,
        'images'=>$image_way
    ));

    if($setQuery)
    {
        header('Location: ../data/category-health-life.php?status=yes');
    }
    else
    {
        header('Location: ../data/category-health-life.php?status=no');
    }
}

elseif(isset($_POST['healthLifeedit']))
{
    $title = htmlspecialchars(trim($_POST['healthLifetitle']));
    $subjectt = htmlspecialchars(trim($_POST['healthLifesubject']));
    $keywords = htmlspecialchars(trim($_POST['healthLifekeywords']));
    $author_id = htmlspecialchars(trim($_POST['author_id']));
    $content = $_POST['healthLifecontent'];
    $id = $_POST['healthLife_id'];

    if($_FILES['healthLifeimages']['tmp_name'])
    {
        $upload_dir = '../assets/img/healthLife';
        $tmp_name = $_FILES['healthLifeimages']["tmp_name"];
        $name = $_FILES['healthLifeimages']["name"];

        $num1 = rand(2000,3200);
        $num2= rand(2000,3200);
        $num3= rand(2000,3200);
        $num4= rand(2000,3200);

        $number = $num1.$num2.$num3.$num4;
        $image_way = substr($upload_dir,30)."/".$number.$name;

        move_uploaded_file($tmp_name,"$upload_dir/$number$name");

        $query = $conn->prepare("UPDATE healt_life SET
            author_id=:id,
            healthLife_title=:title,
            healthLife_keywords=:keywords,
            healthLife_subject=:subjectt,
            healthLife_content=:content,
            healthLife_bgimage=:images
            WHERE healthLife_id={$id}
        ");

        $setQuery = $query->execute(array(
            'id'=>$author_id,
            'title'=>$title,
            'keywords'=>$keywords,
            'subjectt'=>$subjectt,
            'content'=>$content,
            'images'=>$image_way
        ));
        if($setQuery)
        {
            header('Location: ../data/healthLife-display.php?id='.$id);
        }
        else
        {
            header('Location: ../data/healthLife.php?id='.$id.'&&status=no');
        }
    }
    $query = $conn->prepare("UPDATE healt_life SET
            author_id=:id,
            healthLife_title=:title,
            healthLife_keywords=:keywords,
            healthLife_subject=:subjectt,
            healthLife_content=:content
            WHERE healthLife_id={$id}
    ");

    $setQuery = $query->execute(array(
        'id'=>$author_id,
        'title'=>$title,
        'keywords'=>$keywords,
        'subjectt'=>$subjectt,
        'content'=>$content
    ));

    if($setQuery)
    {
        header('Location: ../data/healthLife-display.php?id='.$id);
    }
    else
    {
        header('Location: ../data/healthLife.php?id='.$id.'&&status=no');
    }
}

elseif(isset($_POST['healthLiferemove']))
{
    $img = $_POST['bg_name'];

    $remove = $conn->prepare("DELETE FROM healt_life WHERE healthLife_id=:id");
    $remove->execute(array(
        'id'=>$_POST['id']
    ));

    if($remove)
    {
        unlink('../assets/img/healthLife/'.$img);
        header('Location: ../data/category-health-life.php?status=yes');
    }
    else
    {
        header('Location: ../data/category-health-life.php?status=no');
    }
}

elseif(isset($_POST['healthLifecancel']))
{
    header('Location: ../data/category-health-life.php');
}

elseif(isset($_POST['smtpsave']))
{
    $host = htmlspecialchars(trim($_POST['smtphost']));
    $mail = htmlspecialchars(trim($_POST['smtpemail']));
    $password = htmlspecialchars(trim($_POST['smtppassword']));
    $reply = htmlspecialchars(trim($_POST['smtpreply']));
    $nameSurname = htmlspecialchars(trim($_POST['smtpnamesurname']));

    $query = $conn->prepare("INSERT INTO mail_setting SET
        mail_host =:host,
        mail_sender=:mail,
        mail_password=:password,
        mail_reply=:reply,
        mail_reply_name_surname=:nameSurname
    ");

    $setQuery = $query->execute(array(
        'host'=>$host,
        'mail'=>$mail,
        'password'=>$password,
        'reply'=>$reply,
        'nameSurname'=>$nameSurname
    ));

    if($setQuery)
    {
        header('Location: ../data/index.php?status=yes');
    }
    else
    {
        header('Location: ../data/index.php?status=no');
    }
}

elseif(isset($_POST['messagereply']))
{

    $nameSurname = htmlspecialchars(trim($_POST['nameSurname']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $content = htmlspecialchars(trim($_POST['content']));
    $mail = htmlspecialchars(trim($_POST['mail']));
    $message_id = htmlspecialchars(trim($_POST['message_id']));

    $result = Mail($nameSurname, $subject, $content, $mail);

    if($result)
    {
        $query = $conn->prepare("INSERT INTO messages_reply SET
        message_id =:id,
        reply_content=:content,
        message_status=:status 
    ");

        $setQuery = $query->execute(array(
            'id'=>$message_id,
            'content'=>$content,
            'status'=>1
        ));

        if($setQuery)
        {
            header('Location: ../data/messages.php?status=yes');
        }
        else
        {
            header('Location: ../data/messages.php?status=no');
        }
    }
    else
    {
        header('Location: ../data/messages.php?status=no');
    }
}

?>