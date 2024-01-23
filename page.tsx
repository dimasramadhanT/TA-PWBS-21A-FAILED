"use client";

import axios from 'axios';
import { AnyAaaaRecord } from 'dns';
import React, { useState } from 'react'


export default function AddPage() {
  const [ inputs, setInputs] = useState(
    {
      // penaman object sesuwai dengan id kompenen 
   txt_no : "",
   txt_nama_buku : "",
   txt_penerbite : "",
   
    }
  )

  //buat  arrow fungction untuk menapung data
  const getDataInput = (e: any) => {
    // buat variabel untuk nilai  "id"dan "value" masing-masing kompenen
   const id = e. target.id;
   const value = e.target.value;
   //panggil state
   setInputs((cmp: any) => {
   cmp[id] = value;
   
   console.log(cmp);
   return cmp;
   })
  }
  //buat arrow fungction untuk "setpost"
  const setPost = () => {
    // jika ada salah satu kompenen yang tidak di isi
    if(inputs.txt_no == "" || inputs.txt_nama_buku == "" || 
    inputs.txt_penerbite == "")
    {
      alert("Seluruh Data Wajib Disis")
    }
    // jika semua kompenen di isi
    else
    {
      // alert("Seluruh Data Sudah Disi")
      axios.post( `${process.env.APIMahasiswa}/save`,{
        no: inputs.txt_no,
        nama_buku : inputs.txt_nama_buku,
        penerbit: inputs.txt_penerbite,
      
      })
      .then((response) => {
        alert (response.data.massage)
      })
    }
  }
  // buat arrow function untuk "btn_refresh"
  const setRefresh = () => location.reload();
  return (
    <div>
      {/* area komponen */}
      <section className='flex items-center mb-3'>
        {/* area label */}
        <section className='w-1/4'>
          <label htmlFor="txt_no">NPM</label>
        </section>
        {/* area input */}
        <section className='w-3/4'>
          <input type="text" name="" id="txt_npm" className='w-1/2 border-2 border-black
         px-3 py-1 rounded-lg outline-none focus:border-sky-500' placeholder='Isi Data no'
         onChange={getDataInput}/>
        </section>
      </section>

      {/* area komponen */}
      <section className='flex items-center mb-3'>
        {/* area label */}
        <section className='w-1/4'>
          <label htmlFor="txt_nama_buku">Nama Buku</label>
        </section>
        {/* area input */}
        <section className='w-3/4'>
          <input type="text" name="" id="txt_nama_buku" className='w-1/2 border-2 border-black
         px-3 py-1 rounded-lg outline-none focus:border-sky-500' placeholder='Isi Data Nama buku'onChange={getDataInput}/>
        </section>
      </section>

      {/* area komponen */}
      <section className='flex items-center mb-2'>
        {/* area label */}
        <section className='w-1/4'>
          <label htmlFor="txt_telepone">penerbit</label>
        </section>
        {/* area input */}
        <section className='w-3/4'>
          <input type="text" name="" id="txt_penerbite" className='w-1/2 border-2 border-black
         px-3 py-1 rounded-lg outline-none focus:border-sky-500' placeholder='Isi Nomor penerbite'onChange={getDataInput}/>
        </section>
      </section>

      {/* area komponen */}
      <section className='flex items-center mb-2'>
        {/* area label */}
        <section className='w-1/4'>
        </section>
        {/* area input */}
        <section className='w-3/4'>
          <select name="" id="cbo_judul" className='w-1/2 border-2 border-black
         px-3 py-1 rounded-lg outline-none focus:border-sky-500 bg-white'onChange={getDataInput}>
            <option value="">Pilih nama buku</option>
            <option value="sejarah agama islam">sejarah agama isalam</option>
            <option value="matematika">matematila</option>
            <option value="bahsa inggeris">bahsa ingris</option>
          </select>
        </section>
      </section>

       {/* area komponen */}
       <section className='flex items-center'>
        {/* area label */}
        <section className='w-1/4'>
          
        </section>
        {/* area button */}
        <section className='w-3/4'>
          <button id='btn_simpan' className='mr-2 bg-slate-400 border-2 border-black px-10  py-2.5 w-35 rounded-full text-white active:bg-sky-500 text-center'onClick={setPost}>
            Simpan
          </button>
          <button id='btn_refresh' className='ml-2 bg-rose-400 border-2 border-black px-10 py-2.5 w-35 rounded-full text-white  active:bg-sky-500 text-center' onClick={setRefresh}>
            Refresh
          </button>
          {/* <a href={"/add"} className='ml-2 bg-rose-400 border-2 border-black px-10 py-2.5 w-35 rounded-full text-white  active:bg-sky-500 text-center'>
            Refresh
          </a> */}
        </section>
      </section>
    </div>
  )
}