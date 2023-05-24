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
    <code>Monospace text()</code>
    <section>
      <div class="transaction-card">
        <section class="header">
          <small class="date">DATE: <span id="date">2022/08/02</span></small>
          <small class="group">GROUP:<a id="group" href="#">DOMPET</a></small>
          <small class="id">ID: <span id="id">19445678E</span></small>
        </section>
        <section class="info">
        </section>
        <section class="content h1">
          <i class="fa-solid fa-arrow-up-right-dots"></i>
          <span class="amount">IDR 50.000</span>
        </section>
        <section class="footer">
          <span class="title h5">Hutank</span>
          <span class="action">
            <button class="btn-square btn-outline">
              <i class="fa-regular fa-trash-can"></i>
            </button>
            <button class="btn-square btn-outline">
              <i class="fa-solid fa-pen-to-square"></i>
            </button>
          </span>
        </section>
      </div>
    </section>
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
    <table x-data="{ users: [] }" x-init="fetch('https://jsonplaceholder.typicode.com/users')
              .then(response => response.json())
              .then(data => users = data)">
      <thead>
        <tr>
          <th class="has-background-link-light has-text-link">ID</th>
          <th class="has-background-link-light has-text-link">Username</th>
          <th class="has-background-link-light has-text-link">Name</th>
          <th class="has-background-link-light has-text-link">Phone</th>
          <th class="has-background-link-light has-text-link">Location</th>
          <th class="has-background-link-light has-text-link">Company Name</th>
          <th class="has-background-link-light has-text-link">Website</th>
        </tr>
      </thead>
      <tbody>
        <template x-for="user in users" :key="user.id">
          <tr>
            <td x-text="user.id" class="has-text-link-dark"></td>
            <td x-text="user.username"></td>
            <td x-text="user.name"></td>
            <td x-text="user.phone"></td>
            <td x-text="user.address.city"></td>
            <td x-text="user.company.name"></td>
            <td x-text="user.website"></td>
          </tr>
        </template>
      </tbody>
    </table>
  </main>

</body>

</html>