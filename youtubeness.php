<?php
  require('function.php');

  debug('「「「「「「「「「「「「「「「「「「「「「');
  debug('ユーチューブレイアウト');
  debug('「「「「「「「「「「「「「「「「「「「「「');
  debugLogStart();
  //ログイン認証
  require('auth.php');
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>youtube LAYOUT</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/youtubeness.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/124587158e.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <header>
      <div class="container">
        <div class="header-left header-item">
          <div class="menu-bar">
            <span></span>
            <span></span>
            <span></span>
          </div>
          <div class="logo">
            <h2><i class="fab fa-youtube tube-icon"></i>Tubeness</h2>
          </div>
        </div>
        <div class="header-center header-item">
          <div class="serch-box">
            <input type="text" name="search"　placeholder="検索">
            <button type="button" name="button"><i>serch</i></button>
          </div>
        </div>
        <div class="header-right header-item">
          <div class="login">
            <button type="button" name="button">ログイン</button>
          </div>
        </div>
      </div>
    </header>
    <main>
      <div class="container">
        <div class="primary">
          <div class="primary-inner">
            <div class="">
              <iframe id="player" src="https://www.youtube.com/watch?v=71ZKpvKlgVY" ></iframe>
              <div class="video-description">
                <h1>SampleTitle</h1>
                <p>サンプルサンプルサンプルサンプル</p>
              </div>
            </div>
            <div class="thread">
              <div class="post">
                <input type="text" name="" value="">
              </div>
              <div class="comment">
                <i>icon</i><h5>name</h5>
                <p>content</p>
              </div>
            </div>
          </div>
        </div>
        <div class="secondary">
          <div class="secondary-inner">
            <ul>
              <li>
                <div class="other-thread">
                  <div class="panel">
                    <img src="./image/sample.jpg" alt="" >
                  </div>
                  <div class="description">
                    <h3>heading</h3>
                    <p>ここ>>1の書き込み</p>
                  </div>
                </div>
              </li>
              <li>
                  <div class="other-thread">
                    <div class="panel">
                      <img src="./image/sample.jpg" alt="" width="160" height="90">
                    </div>
                    <div class="description">
                      <h3>heading</h3>
                      <p>ここ>>1の書き込み</p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="other-thread">
                    <div class="panel">
                      <img src="./image/sample.jpg" alt="" width="160" height="90">
                    </div>
                    <div class="description">
                      <h3>heading</h3>
                      <p>ここ>>1の書き込み</p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="other-thread">
                    <div class="panel">
                      <img src="./image/sample.jpg" alt="" width="160" height="90">
                    </div>
                    <div class="description">
                      <h3>heading</h3>
                      <p>ここ>>1の書き込み</p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="other-thread">
                    <div class="panel">
                      <img src="./image/sample.jpg" alt="" width="160" height="90">
                    </div>
                    <div class="description">
                      <h3>heading</h3>
                      <p>ここ>>1の書き込み</p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="other-thread">
                    <div class="panel">
                      <img src="./image/sample.jpg" alt="" width="160" height="90">
                    </div>
                    <div class="description">
                      <h3>heading</h3>
                      <p>ここ>>1の書き込み</p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="other-thread">
                    <div class="panel">
                      <img src="./image/sample.jpg" alt="" width="160" height="90">
                    </div>
                    <div class="description">
                      <h3>heading</h3>
                      <p>ここ>>1の書き込み</p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="other-thread">
                    <div class="panel">
                      <img src="./image/sample.jpg" alt="" width="160" height="90">
                    </div>
                    <div class="description">
                      <h3>heading</h3>
                      <p>ここ>>1の書き込み</p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="other-thread">
                    <div class="panel">
                      <img src="./image/sample.jpg" alt="" width="160" height="90">
                    </div>
                    <div class="description">
                      <h3>heading</h3>
                      <p>ここ>>1の書き込み</p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="other-thread">
                    <div class="panel">
                      <img src="./image/sample.jpg" alt="" width="160" height="90">
                    </div>
                    <div class="description">
                      <h3>heading</h3>
                      <p>ここ>>1の書き込み</p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="other-thread">
                    <div class="panel">
                      <img src="./image/sample.jpg" alt="" width="160" height="90">
                    </div>
                    <div class="description">
                      <h3>heading</h3>
                      <p>ここ>>1の書き込み</p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="other-thread">
                    <div class="panel">
                      <img src="./image/sample.jpg" alt="" width="160" height="90">
                    </div>
                    <div class="description">
                      <h3>heading</h3>
                      <p>ここ>>1の書き込み</p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="other-thread">
                    <div class="panel">
                      <img src="./image/sample.jpg" alt="" width="160" height="90">
                    </div>
                    <div class="description">
                      <h3>heading</h3>
                      <p>ここ>>1の書き込み</p>
                    </div>
                  </div>
                </li>
            </ul>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>
