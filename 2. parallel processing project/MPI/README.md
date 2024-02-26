# How to build and test

make clean

make

./gendata t.txt q.txt 

mpiexec -n 1 ./myknnMPI t.txt q.txt
mpiexec -n 2 ./myknnMPI t.txt q.txt
# etc
