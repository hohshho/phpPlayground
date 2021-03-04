import React, {Component} from 'react';
import BoardListItem from './BoardListItem';
import ServiceData from './ServiceData';
import { Link } from 'react-router-dom'

class BoardList extends Component{
    constructor(props) {
        super(props);
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
                            <BoardListItem ServiceData={ServiceData}/>
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