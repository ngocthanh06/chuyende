// import { setAuthorization } from "./general.js";
export function login(credentials) {
  return new Promise((res, rej) => {
    axios.post('/api/auth/login', credentials)
      .then(response => {
        // setAuthorization(response.data.access_token); 
        res(response.data);
      })
      .catch(errs => {
        rej('Sai tên đăng nhập hoặc mật khẩu');
      })
  })
}

export function getLocalUser() {
  const userStr = localStorage.getItem('user');

  if (!userStr) {
      return null
  }

  return JSON.parse(userStr);
}

export function handleAuthorization() {
  var access_token = localStorage.getItem('access_token');
  axios.defaults.headers.common['Authorization'] = 'Bearer' + access_token;
  axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
  //Xử lý trạng thái token
  axios.interceptors.response.use(
    //Accept
    function(response) {
      return response;
    },
    function(err) {
      // expired token error
      if (err && err.response && err.response.status === 401) {
          localStorage.removeItem('access_token');
          localStorage.removeItem('user');
          // alert('Đăng nhập hết hạn');

          return router.push({
              name: 'login'
          });
      }
      // validate error
      if (err && err.response && err.response.status === 422) {
          return Promise.reject(err);
      }

      return Promise.reject(err);
    }
  );
}
