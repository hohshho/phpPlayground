import React, { Component } from "react";
import "./Login.css";
import axios from "axios";
import { WithRouter } from "react-router-dom";
import App from "../../App";

import cookie from 'react-cookies';

class Login extends Component {
  constructor(props) {
    super(props);
    this.state = {
      id: "",
      password: "",
    };
  }
  componentDidMount() {}

  onChangeId = (e) => {
    this.setState({ id: e.target.value });
  };

  onChangePassword = (e) => {
    this.setState({ password: e.target.value });
  };

  onSubmitLogin = async (e) => {
    e.preventDefault();
    let axiosRes;
    let axiosResult = async () => {
      let b = await axios({
        method: "post",
        url: "http://localhost/board/login_user",
        data: {
          id: this.state.id,
          password: this.state.password,
        },
      });
      return b;
    };
    axiosRes = await axiosResult();
    window.sessionStorage.setItem("logged", "true");
    window.sessionStorage.setItem("accessToken", axiosRes.data);
    console.log(axiosRes);
    // TODO : 로그인 성공 / 실패 모달
    if(axiosRes.data){
      cookie.save('accessToken', axiosRes.data,{
        path:"/",
        httpOnly:true
      })
      console.log('토큰 저장 완료!');
    }else{
      console.log('로그인은 됐는데 토큰 저장이 안되요 ㅜㅜ')
    }
    this.props.history.push("/");
  };
  onSubmitSignUp = async (e) => {
    e.preventDefault();
    this.props.history.push("/signup");
  };

  render() {
    return (
      <>
        <form onSubmit={this.onSubmit} style={{ padding: 10 }}>
          {/* ID input tag */}
          <div>
            <label htmlFor="user-id">아이디</label>
            <br />
            <div className="col-lg-12">
              <div className="form-group text_box">
                <input
                  name="user-id"
                  placeholder="ID"
                  type="text"
                  required
                  onChange={(e) => this.onChangeId(e)}
                />
              </div>
            </div>
          </div>

          {/* Name input tag */}
          <div>
            <label htmlFor="user-password">패스워드</label>
            <br />
            <div className="col-lg-12">
              <div className="form-group text_box">
                <input
                  name="user-password"
                  placeholder="Password"
                  type="password"
                  required
                  onChange={(e) => this.onChangePassword(e)}
                />
              </div>
            </div>
          </div>

          <button type="submit" className="btn_three" onClick={(e) => this.onSubmitLogin(e)}>
            로그인
          </button>
          <button type="button" className="btn_three" onClick={(e) => this.onSubmitSignUp(e)}>
            회원 가입
          </button>
        </form>
      </>
    );
  }
}

export default Login;
