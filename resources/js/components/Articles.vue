<template>
  <div class="container">
    <h2>Articles</h2>

    <form @submit.prevent="addArticle" class="mb-3">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Title" v-model="article.title">
      </div>
      <div class="form-group">
        <textarea name id cols rows class="form-control" placeholder="body" v-model="article.body"></textarea>
      </div>
      <button class="btn btn-success btn-block">Save</button>
    </form>

    <nav>
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
          <a @click="fetchArticles(pagination.prev_page_url)" class="page-link" href="#">Previous</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">page {{pagination.current_page}} of {{pagination.last_page}}</a>
        </li>
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
          <a @click="fetchArticles(pagination.next_page_url)" class="page-link" href="#">Next</a>
        </li>
      </ul>
    </nav>

    <div class="card card-body mb-2" v-for="article in articles" v-bind:key="article.id">
      <h3>{{ article.title }}</h3>
      <p>{{ article.body}}</p>
      <hr>
      <button @click="editArticle(article)" class="btn btn-warning mb-2">Edit</button>
      <button @click="deleteArticle(article.id)" class="btn btn-danger">Delete</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      articles: [],
      article: {
        id: "",
        title: "",
        body: ""
      },
      article_id: "",
      pagination: {},
      edit: false
    };
  },

  created() {
    this.fetchArticles();
  },

  methods: {
    fetchArticles(page_url) {
      let vm = this;
      page_url = page_url || "api/articles";
      axios
        .get(page_url)
        .then(res => {
          this.articles = res.data.data;
          vm.makePagination(res.data.meta, res.data.links);
        })
        .catch(error => console.log(error));
    },

    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };
      this.pagination = pagination;
    },

    deleteArticle(id) {
      if (confirm("Are you sure you want to delete this article")) {
        let url = "api/article/" + id;
        axios
          .delete(url)
          .then(res => {
            alert("Article deleted");
            this.fetchArticles();
          })
          .catch(err => console.log(err));
      }
    },

    addArticle() {
      if (this.edit === false) {
        axios
          .post("api/article", {
            title: this.article.title,
            body: this.article.body
          })
          .then(res => {
            alert("Article created");
            this.fetchArticles();
            this.article.title = "";
            this.article.body = "";
          })
          .catch(err => console.log(err));
      } else {
        //update
        axios
          .put("api/article", {
            title: this.article.title,
            body: this.article.body,
            article_id: this.article.id
          })
          .then(res => {
            alert("Article Updated");
            this.fetchArticles();
            this.article.title = "";
            this.article.body = "";
          })
          .catch(err => console.log(err));
      }
    },

    editArticle(article) {
      this.edit = true;
      this.article.title = article.title;
      this.article.id = article.id;
      this.article.article_id = article.id;
      this.article.body = article.body;
    }
  }
};
</script>