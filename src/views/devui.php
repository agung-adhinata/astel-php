<html>

<head>
  <?php
  Template::getHeadlessHead("Development UI", "dev place for testing ui capabilities");
  ?>
</head>

<body>
  <main style="display: flex; flex-direction: column; gap: 2px;">
    <section>
      <h1 class="reset">this is h1</h1>
      <p>this is paragraph text, no style required i think
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum at totam nobis rerum. Sint veniam totam quo
        ducimus pariatur, porro esse molestias fugit impedit repellendus autem reprehenderit perferendis fuga ut.
      </p>
    </section>
    <h2>this is h2</h2>
    <h3>this is h3</h3>
    <h4>this is h4</h4>
    <h5>this is h5</h5>
    <div>plain text</div>
    <a href="#">links</a>
    <code>Monospace text() </code>
    <section>
      <button>my button</button>
      <button class="btn-secondary">my button</button>
    </section>
    <section>
      <label for="lbl">Label</label>
      <input type="text" name="lbl" id="lbl" />
    </section>
    <section>
      <label for="lbl2">Label</label>
      <input type="date" name="lbl2" id="lbl2" />
    </section>
    <section>
      <div class="flex items-center" style="gap: 0.5em;">
        <input type="radio" name="option" id="option1" value="1" />
        <label for="option1">
          Ikan
        </label>
      </div>
      <div class="flex items-center" style="gap: 0.5em;">
        <input type="radio" name="option" id="option2" value="2" />
        <label for="option2">
          Mamalia
        </label>
      </div>
    </section>
    <section>
      <div class="flex items-center" style="gap: 0.5em;">
        <input type="checkbox" name="check" id="check1" value="1" checked />
        <label for="check1">
          Ikan
        </label>
      </div>
      <div class="flex items-center" style="gap: 0.5em;">
        <input type="checkbox" name="check" id="check2" value="2" />
        <label for="check2">
          Mamalia
        </label>
      </div>
    </section>
  </main>

</body>

</html>