/** @type {import('next').NextConfig} */
const nextConfig = {
    env : {
        APIMahasiswa : 'http://127.0.0.1:8000/api/mahasiswa',
        APIDosen : 'http://127.0.0.1:8000/api/dosen',
    }
}

module.exports = nextConfig