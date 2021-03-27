import React, {Component} from 'react';
import axios from "axios";
import BoardListItem from './BoardListItem';
import { Link } from 'react-router-dom'

class BoardList extends Component{
    constructor(props) {
        super(props);
        this.state = {
            ServiceData : []
        }
    }
    componentDidMount() {
        let postData = this.loadData();
        this.setState({ ServiceData : postData});
    }
    loadData = async (e) => {
        // 페이지 목록 불러올 수 있게 url 수정해야 함
        let axiosResult = async () => {
            let b = await axios({
              method: "get",
              url: "http://localhost/board/board_list/?listIndex=1;",
            });
            return b;
          };
        let axiosIndex = await axiosResult();
        return this.loadData;
    }
    onSubmitWrite = async (e) => {
        this.props.history.push("/board/write");
     };
    render(){
        return(
            <section className="blog_area sec_pad">
                <div className="container">
                    <div className="row">
                        <div className="col-lg-8">
                            {/* <BoardListItem ServiceData={this.state.ServiceData}/> */}
                            {/* 여기가 선택창 */}
                            <ul className="list-unstyled page-numbers shop_page_number text-left mt_30">
                                <li><span aria-current="page" className="page-numbers current">1</span></li>
                                <li><a className="page-numbers" href=".#">2</a></li>
                                <li><a className="next page-numbers" href=".#"><i className="ti-arrow-right"></i></a></li>
                                <Link to="./write"> 
                                    <button className="btn_make">
                                        글쓰기
                                    </button>
                                </Link>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        )
    }
}
export default BoardList;