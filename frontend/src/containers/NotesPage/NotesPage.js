import React from "react";
import {useEffect, useState} from 'react';
import MDEditor from '@uiw/react-md-editor';

export default function NotesPage() {
    const [notes, setNotes] = useState([]);
    const [value, setValue] = useState("**Hello world!!!**");
  
    useEffect(() => {
      async function fetchNotes() {
        const response = await fetch('/api/notes');
        const notes = await response.json();
        setNotes(notes);
      }
  
      fetchNotes();
    }, [])
  
  
    return (
      <div className="App">
        {notes.map((element, index) => (<h1 key={index}>{element.title}</h1>))}
  
        <MDEditor
          value={value}
          onChange={setValue}
        />
      </div>
    );
  }
  