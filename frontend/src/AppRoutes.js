import {BrowserRouter, Routes, Route} from 'react-router-dom';

import Login from './containers/LoginPage/Login';
import Home from './containers/HomePage/HomePage';
import NotesPage from './containers/NotesPage/NotesPage';
import RegisterPage from './containers/RegisterPage/Register';

export default function AppRoutes() {
    return (
        <BrowserRouter>
            <Routes>
                <Route path="/login" exact element={<Login />} />
                <Route path="/register" exact element={<RegisterPage />} />
                <Route path="/notes" exact element={<NotesPage />} />
                <Route path="/" exact element={<Home />} />
            </Routes>
        </BrowserRouter>
    );
}