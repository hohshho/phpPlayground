import React, {Component} from 'react';
class BoardListItem extends Component{
    render(){
        let ServiceData = this.props.ServiceData;
        return(
            <>
                {
                ServiceData.Blist.map(post=>{
                    return(
                        <div className="blog_list_item mb_50"  key={post.id}>
                            <div className="blog_content">
                                <div className="post_date">
                                    <h2>{post.day} <span>{post.month}</span></h2>
                                </div>
                                <div className="entry_post_info">
                                    <a href=".#"> By: {post.user_id}</a>
                                    <a href=".#">2 Comments</a>
                                </div>
                                <a href=".#">
                                    <h5 className="f_p f_size_20 f_500 t_color mb_20">{post.btitle}</h5>
                                </a>
                                <p className="f_400 mb_20">{post.content}</p>
                                <a href=".#" className="learn_btn_two">Read More <i className="ti-arrow-right"></i></a>
                            </div>
                        </div>
                    )
                    })
                }
            </>
        )
    }
}
export default BoardListItem;