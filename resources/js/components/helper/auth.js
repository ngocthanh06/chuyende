
export function login(credentials){
    return new Promise((res, rej) => {
        axios.post('/api/auth/login', credentials)
            .then((response)=>{
               return res(response.data);
            })
            .catch((err) => {
               return rej('Sai tên đăng nhập hoặc mật khẩu');
            })
    })
}

export function getLocalUser(){
    const userStr = localStorage.getItem('user');

    if(!userStr){
        return null;
    }

    return JSON.parse(userStr);
}