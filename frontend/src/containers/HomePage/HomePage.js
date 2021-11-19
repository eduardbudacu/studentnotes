import {Link} from 'react-router-dom';

export default function HomePage() {
    return (
        <div>
            <h1>Student notes</h1>

            <Link to="/login">Login</Link> | <Link to="/register">Register</Link>
        </div>
    )
}