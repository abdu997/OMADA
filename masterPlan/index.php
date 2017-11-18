<style>
    @charset "UTF-8";
    body {
      font-weight: 300;
      color: #333;
      box-sizing: border-box;
    }
    body * {
      box-sizing: border-box;
    }

    .timeline {
      max-width: 800px;
      background: #fff;
      padding: 100px 50px;
      position: relative;
    }
    .timeline:before {
      content: '';
      position: absolute;
      top: 0px;
      left: calc(33% + 15px);
      bottom: 0px;
      width: 4px;
      background: #2196F3!important;
    }
    .timeline:after {
      content: "";
      display: table;
      clear: both;
    }

    .entry {
      clear: both;
      text-align: left;
      position: relative;
    }
    .entry .title {
      margin-bottom: .5em;
      float: left;
      width: 33%;
      padding-right: 30px;
      text-align: right;
      position: relative;
    }
    .entry .title:before {
      content: '';
      position: absolute;
      width: 8px;
      height: 8px;
      border: 4px solid salmon;
      background-color: #fff;
      border-radius: 100%;
      top: 15%;
      right: -8px;
      z-index: 99;
    }
    .entry.10 .title:before {
      content: '';
      position: absolute;
      width: 8px;
      height: 8px;
      border: 4px solid salmon;
      background-color: #fff;
      border-radius: 100%;
      top: 15%;
      right: -8px;
      z-index: 99;
    }
    .entry .title h3 {
      margin: 0;
      font-size: 120%;
    }
    .entry .title p {
      margin: 0;
      font-size: 100%;
    }
    .title.final {
        color: green;
        font-size: 20px
    }
    .entry.final .title:before {
      content: '';
      position: absolute;
      width: 8px;
      height: 8px;
      border: 10px solid green;
      background-color: #fff;
      border-radius: 100%;
      top: 15%;
      right: -14px;
      z-index: 99;
    }
    .title.one {
        color: #1abc9c;
    }
    .entry.one .title:before {
      content: '';
      position: absolute;
      width: 8px;
      height: 8px;
      border: 4px solid #1abc9c;
      background-color: #fff;
      border-radius: 100%;
      top: 15%;
      right: -8px;
      z-index: 99;
    }
    .entry .body {
      margin: 0 0 3em;
      float: right;
      width: 66%;
      padding-left: 30px;
    }
    .entry .body p {
      line-height: 1.4em;
    }
    .entry .body p:first-child {
      margin-top: 0;
      font-weight: 400;
    }
    .entry .body ul {
      color: #aaa;
      padding-left: 0;
      list-style-type: none;
    }
    .entry .body ul li:before {
      content: "–";
      margin-right: .5em;
    }
</style>
<div class="timeline">
  <div class="entry one">
    <div class="title one">
      <h3>Title</h3>
      <p>Step 1</p>
    </div>
    <div class="body">
      <p>Voluptatibus veniam ea reprehenderit atque reiciendis non laborum adipisci ipsa pariatur omnis.</p>
    </div>
  </div>
  <div class="entry final">
    <div class="title final">
      <h3>Title</h3>
      <p>Final</p>
    </div>
    <div class="body">
      <p>Voluptatibus veniam ea reprehenderit atque reiciendis non laborum adipisci ipsa pariatur omnis.</p>
    </div>
  </div>
</div>