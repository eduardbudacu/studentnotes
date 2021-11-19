import {React, useState, useEffect} from 'react';
import {useForm} from 'react-hook-form';
import { Navigate, useNavigate } from 'react-router';

export default function RegisterPage() {
    const [institutions, setInstitutions] = useState([]);
    const navigate = useNavigate();

    const {
        register,
        handleSubmit,
        formState: {errors},
        reset
    } = useForm();

    useEffect(() => {loadInstitutions()}, [])

    const loadInstitutions = async () => {
        let response = await fetch('/api/institutions')
        if(response.status == '200') {
            let jsonData = await response.json()
            setInstitutions(jsonData)
        }
    }

    const onSubmit = async (data) => {
        let response = await fetch('/api/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        if(response.status == '201') {
            navigate('/login')
        }
        console.log(data)
    }

    

    return (
        <section className="section-input">
            <form onSubmit={handleSubmit(onSubmit)}>
                <h3>Register</h3>

                <div className="form-group">
                    <label>Name</label>
                    <input type="text" {...register('name')} className="form-control" placeholder="Enter name" />
                </div>

                <div className="form-group">
                    <label>Email</label>
                    <input type="email" {...register('email')} className="form-control" placeholder="Enter email" />
                </div>

                <div className="form-group">
                    <label>Password</label>
                    <input type="password" {...register('password')} className="form-control" placeholder="Enter password" />
                </div>

                <div className="form-group">
                    <label>Confirm password</label>
                    <input type="password_confirmation" {...register('password_confirmation')} className="form-control" placeholder="Confirm password" />
                </div>

                <div className="form-group">
                    <label>Institution</label>
                    <select className="form-control" {...register('institution_id')}>
                        <option>Choose institution</option>
                        {institutions.map(el => (<option key={el.id} value={el.id}>{el.name}</option>))}
                    </select>
                </div>

                <div className="form-group" style={{marginTop: "10px", textAlign:"right"}}>
                    <input type="submit" className="btn btn-primary" />
                </div>
            </form>
        </section>
    )
}