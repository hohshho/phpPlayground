/*global kakao */
import React, { Component } from "react";
import "./SignUp.css";
import axios from "axios";
import JoinModal from "../../Components/Modal/JoinModal";

class SignUp extends Component {
  constructor(props) {
    super(props);
    this.state = {
      id: "",
      name: "",
      password: "",
      passwordCheck: "",
      birth: "",
      address: "",
      passwordError: false,
      termError: false,
      showResults: false,
      message: "",
      successJoin : false
    };
  }
  // TODO : state 값 입력받을 때 정해진 유형에 맞지 않으면 password처럼 떠야함
  chageMessage = (index) => {
    let str;
    if(index){
      str = this.state.name + "님의 아이디는 " + this.state.id + "입니다. \n ";
      this.setState({ successJoin: false });
    }else {
      str ="회원 가입에 실패하셨습니다. 다시 회원가입 해주세요!";
    }
    this.setState({ message: str });
  };

  routeChange = () => {
    if(this.state.successJoin){
      this.props.history.push("/login");
    }else {
      this.props.history.push("/signup");
      // TODO : url에 값이 남아있네 없애줘야 한다.
    }
  };

  successModal = async (e) => {
    let changeMessage = await this.chageMessage(true);
    let changeModal = await this.setState({ showResults: true });
  };

  failModal = async (e) => {
    let changeMessage = await this.chageMessage(false);
    let changeModal = await this.setState({ showResults: true });
  };

  onSubmit = async (e) => {
    e.preventDefault();
    if (this.state.password !== this.state.passwordCheck) {
      return this.setState({ passwordError: true });
    }
    let axiosResult = async () => {
      let b = await axios({
        method: "post",
        url: "http://localhost/board/sign_up_user",
        data: {
          id: this.state.id,
          name: this.state.name,
          password: this.state.password,
          birth: this.state.birth,
          address: this.state.address
        },
      });
      return b;
    };

    let axiosIndex = await axiosResult();
    if(axiosIndex.data==true){
      this.successModal();
    }else{
      this.failModal();
    }
    return;
  };

  onChangeId = (e) => {
    this.setState({ id: e.target.value });
  };
  onChangeName = (e) => {
    this.setState({ name: e.target.value });
  };
  onChangePassword = (e) => {
    // TODO : password 원하는 게 정규식으로 검사
    this.setState({ password: e.target.value });
  };
  onChangePasswordChk = (e) => {
    if (e.target.value !== this.state.password) {
      this.setState({ passwordError: true });
    } else {
      this.setState({ passwordError: false });
    }
    this.setState({ passwordCheck: e.target.value });
  };
  onChangeBrith = (e) => {
    this.setState({ birth: e.target.value });
  };

  onChangeAddress = (e) => {
    this.setState({ address: e.target.value });
  };

  componentDidMount() {}

  render() {
    return (
      <>
        <form style={{ padding: 10 }}>
          {/* ID input tag */}
          <div>
            <label htmlFor="user-id">아이디</label>
            <br />
            <div className="col-lg-12">
              <div className="form-group text_box">
                <input
                  name="user-id"
                  placeholder="Email"
                  type="text"
                  required
                  onChange={(e) => this.onChangeId(e)}
                />
              </div>
            </div>
          </div>

          {/* Name input tag */}
          <div>
            <label htmlFor="user-name">이름</label>
            <br />
            <div className="col-lg-12">
              <div className="form-group text_box">
                <input
                  name="user-name"
                  placeholder="Name"
                  type="text"
                  required
                  onChange={(e) => this.onChangeName(e)}
                />
              </div>
            </div>
          </div>

          {/* PASSWORD input tag */}
          <div>
            <label htmlFor="user-password">비밀번호</label>
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

          {/* PASSWORD_CHECK input tag */}
          <div>
            <label htmlFor="user-password-check">비밀번호체크</label>
            <br />
            <div className="col-lg-12">
              <div className="form-group text_box">
                <input
                  name="user-password-check"
                  placeholder="PasswordCheck"
                  type="password"
                  required
                  onChange={(e) => this.onChangePasswordChk(e)}
                />
              </div>
            </div>
            {this.state.passwordError && (
              <div style={{ color: "red" }}>비밀번호가 일치하지 않습니다.</div>
            )}
          </div>

          {/* birth tag */}
          <div>
            <label htmlFor="user-birth">생년월일</label>
            <br />
            <div className="col-lg-12">
              <div className="form-group text_box">
                <input
                  name="user-birth"
                  placeholder="Birth"
                  type="text"
                  required
                  onChange={(e) => this.onChangeBrith(e)}
                />
              </div>
            </div>
          </div>

          {/* address */}
          <div>
            <label htmlFor="user-address">주소</label>
            <br />{" "}
            <div className="col-lg-12">
              <div className="form-group text_box">
                <input
                  type="text"
                  name="user-address"
                  placeholder="Address"
                  required
                  onChange={(e) => this.onChangeAddress(e)}
                />
              </div>
            </div>
          </div>
          {/* <div>
          <Checkbox name="user-term" value={term} onChange={onChangeTerm}>
            동의 합니까?
          </Checkbox>
          {termError && <div style={{ color: "red" }}>약관에 동의하셔야 합니다.</div>}
        </div> */}
          <button onClick={this.onSubmit} className="btn_three">
            회원 가입
          </button>
          {this.state.showResults ? (
            <JoinModal
              title="환영합니다! "
              message={this.state.message}
              submit={this.routeChange}
              confirm={this.state.successJoin ==true ? "로그인창으로 이동":"회원가입창으로 이동"}
            />
          ) : null}
        </form>
      </>
    );
  }
}

export default SignUp;
