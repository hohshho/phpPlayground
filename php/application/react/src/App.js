import React, { Component } from "react";
import { BrowserRouter as Router, Switch, Route } from "react-router-dom";
import ScrollToTopRoute from "./ScrollToTopRoute";
import Home from "./pages/Home/Home";
import SignUp from "./pages/SignUp/SignUp";
import BoardMain from "./pages/Board/Main/Main";
import BoardWrite from "./pages/Board/Write/Write";
import Login from "./pages/Login/Login";
import NotFound from "./pages/404";
import BoardDetail from "./pages/Board/Detail/Detail";
/*------ Pages-----*/

// TODO : axios호출 시 jwt 같이 보내야 함. // server는 token 검증하는 로직 필요
class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      payAmount : 0
    }
    // window.sessionStorage.setItem("logged", "false");
    // if (window.sessionStorage.getItem("accessToken")) {
      // TODO : accessToken보고 로그인 만료시간 끝나지 않았으면 TRUE
    //   window.sessionStorage.setItem("logged", "true");
    // }
  }

  componentDidMount() {
    this.props.hideLoader();
  }
  render() {
    const aa = "d";
    return (
      <Router>
        <Switch>
          <ScrollToTopRoute exact={true} path={"/"} component={Home} />
          <ScrollToTopRoute exact={true} path={"/signUp"} component={SignUp} />
          <ScrollToTopRoute data={"a"} exact={true} path={"/login"} component={Login} />
          <ScrollToTopRoute exact={true} path={"/board/main"} component={BoardMain} />
          <ScrollToTopRoute exact={true} path={"/board/write"} component={BoardWrite} />
          <ScrollToTopRoute exact={true} path={"/board/detail"} component={BoardDetail} />
          <ScrollToTopRoute component={NotFound} />
        </Switch>
      </Router>
    );
  }
}

export default App;
