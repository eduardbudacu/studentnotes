import {BrowserRouter, Routes, Route} from 'react-router-dom';

import Login from './containers/LoginPage/Login';
import Home from './containers/HomePage/HomePage';
import NotesPage from './containers/NotesPage/NotesPage';

export default function AppRoutes() {
    return (
        <BrowserRouter>
            <Routes>
                <Route path="/login" exact element={<Login />} />
                <Route path="/notes" exact element={<NotesPage />} />
                <Route path="/" exact element={<Home />} />
            </Routes>
        </BrowserRouter>
    );
}