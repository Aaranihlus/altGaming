export class Comment {

  constructor() {

  }

  store(post_id, comment) {
    axios.post('/comment/store', {
      comment: comment,
      post_id: post_id
    })
    .then(function (response) {
      console.log(response);
    })
    .catch(function (error) {
      console.log(response);
    });
  }

  delete( comment_id ) {
    axios.post('/comment/delete', {
      comment_id: comment_id
    })
    .then(function (response) {
      console.log(response);
    })
    .catch(function (error) {
      console.log(response);
    });
  }

}
