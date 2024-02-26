#include <iostream>
#include <omp.h>

int main() {
    const int size = 100; // Size of the array
    int numbers[size]; // Array to store numbers
    double total_sum = 0.0; // Total sum of all numbers

    // Initialize the array with numbers
    for (int i = 0; i < size; i++) {
        numbers[i] = i + 1;
    }

    int num_threads = omp_get_max_threads(); // Get the maximum number of threads

    // Calculate the number of tasks
    int num_tasks = num_threads;

    omp_set_num_threads(num_threads);

    // Create tasks to calculate partial sums
    #pragma omp parallel shared(numbers, total_sum, num_tasks)
    {
        #pragma omp single
        {
            // Divide the work among tasks
            for (int i = 0; i < num_tasks; i++) {
                // Calculate the chunk size
                int chunk_size = size / num_tasks;
                int start = i * chunk_size;
                int end = start + chunk_size;

                // Create a task for each chunk
                #pragma omp task shared(numbers, total_sum, start, end)
                {
                    double partial_sum = 0.0;
                    // Calculate the partial sum
                    for (int j = start; j < end; j++) {
                        partial_sum += numbers[j];
                    }
                    // Add the partial sum to the total sum
                    #pragma omp atomic
                    total_sum += partial_sum;
                }
            }
        }
    }

    // Calculate the average
    double average = total_sum / size;

    std::cout << "Average: " << average << std::endl;

    return 0;
}
